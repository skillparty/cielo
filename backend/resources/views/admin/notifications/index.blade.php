@extends('admin.layouts.app')

@section('title', 'Panel de Notificaciones')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Panel de Notificaciones</h1>
            <p class="mb-0">Gestiona emails y notificaciones del sistema</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Trabajos Pendientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['pending_jobs'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Trabajos Fallidos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['failed_jobs'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pedidos Hoy
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['orders_today'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pedidos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['total_orders'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Acciones Rápidas</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#testEmailModal">
                                <i class="fas fa-envelope-open"></i> Probar Email
                            </button>
                        </div>
                        <div class="col-md-3 mb-2">
                            <button type="button" class="btn btn-info btn-block" data-bs-toggle="modal" data-bs-target="#bulkNotificationModal">
                                <i class="fas fa-bullhorn"></i> Envío Masivo
                            </button>
                        </div>
                        <div class="col-md-3 mb-2">
                            <form method="POST" action="{{ route('admin.notifications.retry-failed') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-block" 
                                        onclick="return confirm('¿Reintentar todos los trabajos fallidos?')">
                                    <i class="fas fa-redo"></i> Reintentar Fallidos
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3 mb-2">
                            <form method="POST" action="{{ route('admin.notifications.clear-failed') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block" 
                                        onclick="return confirm('¿Limpiar todos los trabajos fallidos?')">
                                    <i class="fas fa-trash"></i> Limpiar Fallidos
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Queue Information -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración del Sistema</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Cola de Trabajos</h6>
                            <p class="text-muted mb-1"><strong>Driver:</strong> {{ config('queue.default') }}</p>
                            <p class="text-muted mb-1"><strong>Conexión:</strong> Base de datos</p>
                            <p class="text-muted"><strong>Estado:</strong> 
                                <span class="badge bg-success">Activo</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Configuración de Email</h6>
                            <p class="text-muted mb-1"><strong>Driver:</strong> {{ config('mail.default') }}</p>
                            <p class="text-muted mb-1"><strong>Desde:</strong> {{ config('mail.from.address') }}</p>
                            <p class="text-muted"><strong>Nombre:</strong> {{ config('mail.from.name') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Email Modal -->
<div class="modal fade" id="testEmailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Probar Configuración de Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.notifications.test-email') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="testEmail" class="form-label">Email de Destino</label>
                        <input type="email" class="form-control" id="testEmail" name="email" 
                               placeholder="test@ejemplo.com" required>
                        <div class="form-text">
                            Se enviará un email de prueba a esta dirección para verificar la configuración.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Email de Prueba</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Notification Modal -->
<div class="modal fade" id="bulkNotificationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Envío Masivo de Notificaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.notifications.bulk-send') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Destinatarios</label>
                                <select class="form-control" name="recipients" id="recipients" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="all">Todos los usuarios</option>
                                    <option value="role">Por rol</option>
                                    <option value="specific">Usuarios específicos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3" id="roleField" style="display: none;">
                                <label class="form-label">Rol</label>
                                <select class="form-control" name="role">
                                    <option value="">Seleccionar rol...</option>
                                    <option value="admin">Administradores</option>
                                    <option value="customer">Clientes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="subject" class="form-label">Asunto</label>
                        <input type="text" class="form-control" id="subject" name="subject" 
                               placeholder="Asunto del mensaje" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" 
                                  placeholder="Contenido del mensaje..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Notificaciones</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('recipients').addEventListener('change', function() {
    const roleField = document.getElementById('roleField');
    if (this.value === 'role') {
        roleField.style.display = 'block';
    } else {
        roleField.style.display = 'none';
    }
});

// Auto-refresh stats every 30 seconds
setInterval(function() {
    fetch('{{ route("admin.notifications.queue-stats") }}')
        .then(response => response.json())
        .then(data => {
            // Update pending jobs
            document.querySelector('.border-left-primary .h5').textContent = data.pending;
            // Update failed jobs
            document.querySelector('.border-left-danger .h5').textContent = data.failed;
        })
        .catch(error => console.error('Error fetching stats:', error));
}, 30000);
</script>
@endpush