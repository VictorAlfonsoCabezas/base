@if (session("mensaje"))
    <div class="alert alert-dark alert-dismissible alert-sm" data-auto-dismiss="3000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4 style="color: yellow;"><i class="icon fa fa-check"></i> Notificación </h4>
        <ul>
            <li>{{ session("mensaje") }}</li>
        </ul>
    </div>
@endif