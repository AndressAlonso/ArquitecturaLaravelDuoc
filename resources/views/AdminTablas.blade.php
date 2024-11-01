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
            @foreach ($columns as $column)
                @if ($column !== 'created_at' && $column !== 'updated_at')
                    <div class="w-100">
                        <label for="{{$column}}"
                            class="form-label text-capitalize">{{ str_ireplace('_', ' ', $column) }}</label>
                        <input type="text" maxlength="150" name="{{$column}}" required id="emailInput"
                            class="form-control w-100 border-dark" placeholder="{{ $column }}">
                    </div>
                @endif 
            @endforeach
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
                                <th class="text-center" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    @foreach ($columns as $column)
                                        <td>{{ $row->$column }}</td>
                                    @endforeach
                                    <td class="text-center">
                                        <button id="modificar" class="btn btn-outline-secondary btn-sm" title="Edit">
                                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706l-1 1a.5.5 0 0 1-.708 0L11.5 2.207 13.793.5a.5.5 0 0 1 .707 0l1 1zM1 13.5V16h2.5l7.5-7.5-2.5-2.5L1 13.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5V16h2.5l7.5-7.5-2.5-2.5L1 13.5zm9-7.5l-1-1L13.5.5l1 1-5 5z" />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action="{{ route('eliminar-dato', ['table' => $table, 'id' => $row->id]) }}">
                                            @csrf
                                            <input type="hidden" name="table" value="{{ $table }}">
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v7a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zM10.5 5.5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                    <path fill-rule="evenodd"
                                                        d="M11.5 2a1 1 0 0 1 1 1v1H3V3a1 1 0 0 1 1-1h6zM4.118 3L4 4h8l-.118-1H4.118zM5.5 5.5A.5.5 0 0 1 6 6v7a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zM10.5 5.5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1 1 1v1H1V4a1 1 0 0 1 1-1h10zM1.5 4a.5.5 0 0 0-.5.5V5h13v-.5a.5.5 0 0 0-.5-.5h-12z" />
                                                </svg>
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