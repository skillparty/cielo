<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    /**
     * Procesar pago con código QR
     */
    public function processQrPayment(Payment $payment, ?UploadedFile $receiptImage = null): bool
    {
        try {
            if ($receiptImage) {
                // Guardar imagen del comprobante
                $filename = $this->storeReceiptImage($payment, $receiptImage);
                
                $payment->update([
                    'receipt_file_path' => $filename,
                    'status' => 'verification_required',
                    'verification_status' => 'pending',
                ]);

                $payment->order->update(['status' => 'payment_verification']);

                // Aquí se podría implementar OCR para extraer datos automáticamente
                $this->processReceiptWithOCR($payment);

                return true;
            } else {
                // Sin comprobante, marcar como pendiente
                $payment->update(['status' => 'pending']);
                $payment->order->update(['status' => 'payment_pending']);
                return true;
            }
        } catch (\Exception $e) {
            Log::error('Error procesando pago QR: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Procesar pago con tarjeta
     */
    public function processCardPayment(Payment $payment, array $cardData): bool
    {
        try {
            // Aquí se integraría con una pasarela de pago real
            // Por ejemplo: Stripe, PayPal, etc.
            
            // Simulación de procesamiento
            $result = $this->callPaymentGateway($payment, $cardData);
            
            if ($result['success']) {
                $payment->update([
                    'status' => 'completed',
                    'gateway_transaction_id' => $result['transaction_id'],
                    'gateway_reference' => $result['reference'],
                    'gateway_response' => $result,
                ]);

                $payment->order->update(['status' => 'paid']);
                return true;
            } else {
                $payment->update([
                    'status' => 'failed',
                    'gateway_response' => $result,
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Error procesando pago con tarjeta: ' . $e->getMessage());
            $payment->update(['status' => 'failed']);
            return false;
        }
    }

    /**
     * Procesar pago contra entrega
     */
    public function processCashOnDeliveryPayment(Payment $payment): bool
    {
        try {
            $payment->update(['status' => 'pending']);
            $payment->order->update(['status' => 'preparing']);
            return true;
        } catch (\Exception $e) {
            Log::error('Error procesando pago contra entrega: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Verificar pago QR manualmente (para administradores)
     */
    public function verifyQrPayment(Payment $payment, bool $approved, ?string $notes = null, ?int $verifiedBy = null): bool
    {
        try {
            $status = $approved ? 'approved' : 'rejected';
            
            $payment->update([
                'verification_status' => $status,
                'verification_notes' => $notes,
                'verified_at' => now(),
                'verified_by' => $verifiedBy,
                'status' => $approved ? 'completed' : 'failed',
            ]);

            if ($approved) {
                $payment->order->update(['status' => 'paid']);
            } else {
                $payment->order->update(['status' => 'payment_pending']);
                // Restaurar stock si el pago fue rechazado
                $this->restoreStock($payment->order);
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Error verificando pago QR: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Procesar reembolso
     */
    public function processRefund(Payment $payment, float $amount = null): bool
    {
        try {
            $refundAmount = $amount ?? $payment->amount;
            
            if ($payment->payment_method === 'card' && $payment->gateway_transaction_id) {
                // Procesar reembolso con la pasarela de pago
                $result = $this->processGatewayRefund($payment, $refundAmount);
                
                if (!$result['success']) {
                    return false;
                }
            }

            $payment->update([
                'status' => 'refunded',
                'metadata' => array_merge($payment->metadata ?? [], [
                    'refund_amount' => $refundAmount,
                    'refund_date' => now()->toISOString(),
                ]),
            ]);

            $payment->order->update(['status' => 'refunded']);
            
            // Restaurar stock
            $this->restoreStock($payment->order);

            return true;
        } catch (\Exception $e) {
            Log::error('Error procesando reembolso: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Guardar imagen del comprobante
     */
    private function storeReceiptImage(Payment $payment, UploadedFile $image): string
    {
        $filename = 'receipts/' . $payment->id . '_' . time() . '.' . $image->extension();
        $image->storeAs('public', $filename);
        return $filename;
    }

    /**
     * Procesar comprobante con OCR (placeholder)
     */
    private function processReceiptWithOCR(Payment $payment): void
    {
        // Aquí se podría implementar OCR para extraer:
        // - Monto del pago
        // - Número de referencia
        // - Fecha y hora
        // - Entidad bancaria
        
        // Por ahora, solo registramos que se procesó
        $payment->update([
            'ocr_data' => [
                'processed_at' => now()->toISOString(),
                'auto_verification' => false, // Requiere verificación manual
            ],
        ]);
    }

    /**
     * Llamar a la pasarela de pago (simulado)
     */
    private function callPaymentGateway(Payment $payment, array $cardData): array
    {
        // Simulación de llamada a pasarela de pago
        // En producción, aquí se haría la llamada real a Stripe, PayPal, etc.
        
        return [
            'success' => true,
            'transaction_id' => 'TXN_' . time() . '_' . $payment->id,
            'reference' => 'REF_' . strtoupper(uniqid()),
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'gateway' => 'stripe', // o la pasarela que se use
        ];
    }

    /**
     * Procesar reembolso en la pasarela
     */
    private function processGatewayRefund(Payment $payment, float $amount): array
    {
        // Simulación de reembolso en pasarela
        return [
            'success' => true,
            'refund_id' => 'RF_' . time() . '_' . $payment->id,
            'amount' => $amount,
        ];
    }

    /**
     * Restaurar stock de productos
     */
    private function restoreStock(Order $order): void
    {
        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }
    }

    /**
     * Obtener métodos de pago disponibles
     */
    public static function getAvailablePaymentMethods(): array
    {
        return [
            'qr' => [
                'name' => 'Código QR',
                'description' => 'Paga con QR de tu banco móvil',
                'icon' => 'qr-code',
                'enabled' => true,
            ],
            'card' => [
                'name' => 'Tarjeta de Crédito/Débito',
                'description' => 'Visa, Mastercard, American Express',
                'icon' => 'credit-card',
                'enabled' => config('payments.card_enabled', false),
            ],
            'cash_on_delivery' => [
                'name' => 'Efectivo Contra Entrega',
                'description' => 'Paga cuando recibas tu pedido',
                'icon' => 'cash',
                'enabled' => true,
            ],
        ];
    }

    /**
     * Validar datos de tarjeta
     */
    public static function validateCardData(array $cardData): array
    {
        $errors = [];

        if (empty($cardData['number']) || !self::isValidCardNumber($cardData['number'])) {
            $errors[] = 'Número de tarjeta inválido';
        }

        if (empty($cardData['expiry']) || !self::isValidExpiry($cardData['expiry'])) {
            $errors[] = 'Fecha de vencimiento inválida';
        }

        if (empty($cardData['cvv']) || !self::isValidCvv($cardData['cvv'])) {
            $errors[] = 'CVV inválido';
        }

        return $errors;
    }

    private static function isValidCardNumber(string $number): bool
    {
        // Algoritmo de Luhn para validar números de tarjeta
        $number = str_replace(' ', '', $number);
        
        if (!ctype_digit($number) || strlen($number) < 13 || strlen($number) > 19) {
            return false;
        }

        $sum = 0;
        $alternate = false;
        
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $digit = intval($number[$i]);
            
            if ($alternate) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit = ($digit % 10) + 1;
                }
            }
            
            $sum += $digit;
            $alternate = !$alternate;
        }
        
        return ($sum % 10) === 0;
    }

    private static function isValidExpiry(string $expiry): bool
    {
        if (!preg_match('/^(\d{2})\/(\d{2})$/', $expiry, $matches)) {
            return false;
        }

        $month = intval($matches[1]);
        $year = intval('20' . $matches[2]);

        if ($month < 1 || $month > 12) {
            return false;
        }

        $currentYear = intval(date('Y'));
        $currentMonth = intval(date('m'));

        return ($year > $currentYear) || ($year === $currentYear && $month >= $currentMonth);
    }

    private static function isValidCvv(string $cvv): bool
    {
        return ctype_digit($cvv) && strlen($cvv) >= 3 && strlen($cvv) <= 4;
    }
}