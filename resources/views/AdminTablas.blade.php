@extends('index')
@section('links')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')
<div id="container_T" class="d-flex flex-column flex-lg-row container">
    <div id="left" class="flex-fill">
        <form id="formModificarCrear" method="post" action="{{route('modificar-crear-datos')}}" id="form_login"
            class="d-flex flex-column justify-content-center align-items-center align-items-lg-start container gap-2 my-3">
            @csrf
           <div id="helptext">
           <span class="fw-bold w-100">Crear o Modificar
                {{str_ireplace('_', ' ', $table)}}</span>
            <div >
                <span class="helptext">si quieres modificar un dato debe colocar el ID
                    si solo quieres crear un dato debes colocar en el ID 0</span>
            </div>
           </div>
            <div>
            @foreach ($columns as $column)
                @if ($column !== 'created_at' && $column !== 'updated_at')
                    <div class="w-100">
                        <label for="{{$column}}"
                            class="form-label text-capitalize">{{ str_ireplace('_', ' ', $column) }}</label>
                        <input type="text"  name="{{$column}}" required id="emailInput"
                            class="form-control w-100 border-dark" placeholder="{{ $column }}">
                    </div>
                @endif 
            @endforeach
            </div>
            <input type="hidden" name="table" value="{{$table}}">
            <button type="submit" id="btnsubmit" class="btn btn-dark my-2 bg-black">Crear o Modificar
                {{str_ireplace($table, 'Tipo Servicio Clinico', $table)}}</button>
        </form>
    </div>
    <div id="right" class="flex-fill">
        <div id=""
            class="d-flex flex-column justify-content-center align-items-center container gap-2 my-3">
            <span class="fw-bold text-center text-capitalize">{{str_ireplace('_', ' ', $table)}}</span>
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th class="text-capitalize">{{ str_ireplace('_', ' ', $column) }}</th>
                                @endforeach
                                <th class="text-center" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    @foreach ($columns as $column)
                                        <td class="">{{ $row->$column }}</td>
                                    @endforeach
                                    <td class="text-center">
                                        <button id="modificar" class="btn btn-outline-secondary btn-sm border-0" title="Edit">
                                            <svg version="1.1" width="20" height="20" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve"><g><path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231 c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685 c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176 C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99 L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386 c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z"/><path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904 c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15 s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798 c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z"/></g></svg>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action="{{ route('eliminar-dato', ['table' => $table, 'id' => $row->id]) }}">
                                            @csrf
                                            <input type="hidden" name="table" value="{{ $table }}">
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button type="submit" class="btn btn-outline-danger btn-sm border-0" title="Delete">
                                               <!-- icon666.com - MILLIONS vector ICONS FREE --><svg width="20" height="20" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 348.333 348.334" style="enable-background:new 0 0 348.333 348.334;" xml:space="preserve"><g><path d="M336.559,68.611L231.016,174.165l105.543,105.549c15.699,15.705,15.699,41.145,0,56.85 c-7.844,7.844-18.128,11.769-28.407,11.769c-10.296,0-20.581-3.919-28.419-11.769L174.167,231.003L68.609,336.563 c-7.843,7.844-18.128,11.769-28.416,11.769c-10.285,0-20.563-3.919-28.413-11.769c-15.699-15.698-15.699-41.139,0-56.85 l105.54-105.549L11.774,68.611c-15.699-15.699-15.699-41.145,0-56.844c15.696-15.687,41.127-15.687,56.829,0l105.563,105.554 L279.721,11.767c15.705-15.687,41.139-15.687,56.832,0C352.258,27.466,352.258,52.912,336.559,68.611z"/></g></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/modificar.js')}}"></script>
@endsection