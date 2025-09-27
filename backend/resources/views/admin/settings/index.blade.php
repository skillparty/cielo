@extends('admin.layouts.app')

@section('title', 'Configuraciones del Sistema')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Configuraciones del Sistema</h1>
            <p class="mb-0">Gestiona la configuración general del sistema</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.settings.clear-cache') }}" class="btn btn-warning btn-sm" 
               onclick="return confirm('¿Estás seguro de limpiar el caché?')">
                <i class="fas fa-trash"></i> Limpiar Caché
            </a>
            <a href="{{ route('admin.settings.export') }}" class="btn btn-info btn-sm">
                <i class="fas fa-download"></i> Exportar Config
            </a>
        </div>
    </div>

    <!-- Navegación por pestañas -->
    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab">
                <i class="fas fa-cog"></i> General
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="payment-tab" data-bs-toggle="tab" href="#payment" role="tab">
                <i class="fas fa-credit-card"></i> Métodos de Pago
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="shipping-tab" data-bs-toggle="tab" href="#shipping" role="tab">
                <i class="fas fa-truck"></i> Envíos
            </a>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="settingsTabContent">
        <!-- Configuración General -->
        <div class="tab-pane fade show active" id="general" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración General</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="app_name" class="form-label">Nombre de la Aplicación</label>
                                    <input type="text" class="form-control" id="app_name" name="app_name" 
                                           value="{{ $settings['app_name'] ?? 'Cielo Carnes' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="currency" class="form-label">Moneda</label>
                                    <select class="form-control" id="currency" name="currency" required>
                                        <option value="BOB" {{ ($settings['currency'] ?? 'BOB') === 'BOB' ? 'selected' : '' }}>BOB - Boliviano</option>
                                        <option value="USD" {{ ($settings['currency'] ?? 'BOB') === 'USD' ? 'selected' : '' }}>USD - Dólar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="app_description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="app_description" name="app_description" rows="3">{{ $settings['app_description'] ?? '' }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Teléfono de Contacto</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                           value="{{ $settings['contact_phone'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Email de Contacto</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                           value="{{ $settings['contact_email'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tax_rate" class="form-label">Tasa de Impuestos (%)</label>
                                    <input type="number" class="form-control" id="tax_rate" name="tax_rate" 
                                           step="0.01" min="0" max="100" value="{{ $settings['tax_rate'] ?? 13 }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contact_address" class="form-label">Dirección</label>
                            <textarea class="form-control" id="contact_address" name="contact_address" rows="2">{{ $settings['contact_address'] ?? '' }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="min_order_amount" class="form-label">Monto Mínimo de Pedido</label>
                                    <input type="number" class="form-control" id="min_order_amount" name="min_order_amount" 
                                           step="0.01" min="0" value="{{ $settings['min_order_amount'] ?? 50 }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="max_order_amount" class="form-label">Monto Máximo de Pedido</label>
                                    <input type="number" class="form-control" id="max_order_amount" name="max_order_amount" 
                                           step="0.01" min="0" value="{{ $settings['max_order_amount'] ?? 5000 }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="order_processing_time" class="form-label">Tiempo de Procesamiento (horas)</label>
                                    <input type="number" class="form-control" id="order_processing_time" name="order_processing_time" 
                                           min="1" max="72" value="{{ $settings['order_processing_time'] ?? 24 }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Métodos de Pago -->
        <div class="tab-pane fade" id="payment" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Métodos de Pago</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Información:</strong> Configure los métodos de pago disponibles para los clientes.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                    <h6>Contra Entrega</h6>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="cashOnDelivery" checked>
                                        <label class="custom-control-label" for="cashOnDelivery">Habilitado</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <i class="fas fa-credit-card fa-2x text-primary mb-2"></i>
                                    <h6>Tarjeta de Crédito</h6>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="cardPayment" checked>
                                        <label class="custom-control-label" for="cardPayment">Habilitado</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <i class="fas fa-qrcode fa-2x text-warning mb-2"></i>
                                    <h6>Pago QR</h6>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="qrPayment" checked>
                                        <label class="custom-control-label" for="qrPayment">Habilitado</label>
                                    </div>
                                    <small class="text-muted">Con OCR automático</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card border-secondary">
                                <div class="card-body text-center">
                                    <i class="fas fa-university fa-2x text-secondary mb-2"></i>
                                    <h6>Transferencia</h6>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="bankTransfer">
                                        <label class="custom-control-label" for="bankTransfer">Habilitado</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Configuración de Envíos -->
        <div class="tab-pane fade" id="shipping" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración de Envíos</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-truck"></i>
                        <strong>Información:</strong> Configure las opciones de envío y zonas de cobertura.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-gift fa-2x text-success mb-2"></i>
                                    <h6>Envío Gratis</h6>
                                    <p class="text-muted">Pedidos mayores a:</p>
                                    <h4 class="text-success">Bs. 200</h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                    <h6>Envío Estándar</h6>
                                    <p class="text-muted">2-4 horas</p>
                                    <h4 class="text-primary">Bs. 15</h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-bolt fa-2x text-warning mb-2"></i>
                                    <h6>Envío Express</h6>
                                    <p class="text-muted">1-2 horas</p>
                                    <h4 class="text-warning">Bs. 30</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Manejar cambios en los métodos de pago
document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        // Aquí podrías enviar una petición AJAX para actualizar la configuración
        console.log(this.id + ' changed to: ' + this.checked);
    });
});
</script>
@endpush