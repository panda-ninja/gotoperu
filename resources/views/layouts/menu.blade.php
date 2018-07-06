@if(auth()->guard('admin')->user()->tipo_user=='admin')
    <li><a class="ventas @if(session()->get('menu')=='ventas'){{'activo'}}@endif" href="{{route('index_path')}}">Ventas</a></li>
    <li><a class="reservas @if(session()->get('menu')=='reservas'){{'activo'}}@endif" href="{{route('book_path')}}">Reservas</a></li>
    <li><a class="contabilidad @if(session()->get('menu')=='contabilidad'){{'activo'}}@endif" href="{{route('contabilidad_index_path')}}">Contabilidad</a></li>
    <li><a class="operaciones @if(session()->get('menu')=='operaciones'){{'activo'}}@endif" href="{{route('operaciones_path')}}">Operaciones</a></li>
    <li><a class="reportes @if(session()->get('menu')=='reportes'){{'activo'}}@endif" href="{{route('reportes_path')}}">Reportes</a></li>
@endif
@if(auth()->guard('admin')->user()->tipo_user=='ventas')
    <li><a class="ventas @if(session()->get('menu')=='ventas'){{'activo'}}@endif" href="{{route('index_path')}}">Ventas</a></li>
@endif
@if(auth()->guard('admin')->user()->tipo_user=='reservas')
    <li><a class="reservas @if(session()->get('menu')=='reservas'){{'activo'}}@endif" href="{{route('book_path')}}">Reservas</a></li>
    <li><a class="operaciones @if(session()->get('menu')=='operaciones'){{'activo'}}@endif" href="{{route('operaciones_path')}}">Operaciones</a></li>
@endif
@if(auth()->guard('admin')->user()->tipo_user=='contabilidad')
    <li><a class="contabilidad @if(session()->get('menu')=='contabilidad'){{'activo'}}@endif" href="{{route('contabilidad_index_path')}}">Contabilidad</a></li>
@endif
@if(auth()->guard('admin')->user()->tipo_user=='operaciones')
    <li><a class="operaciones @if(session()->get('menu')=='operaciones'){{'activo'}}@endif" href="{{route('operaciones_path')}}">Operaciones</a></li>
@endif