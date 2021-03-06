@extends('layout.principal')
@section('conteudo')
<h1 class="text">Usuários </h1>

@if(empty($usuario))
    <div class="alert alert-danger">
    Você não tem nenhum usuário cadastrado.
    </div>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Perfil</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>

        </tr>
    </thead>
    @foreach ($usuario as $c)
    <tr>
        <td>{{ $c->nome }}</td>
        <td>{{ $c->email }}</td>
        <td>{{ $c->tipousuario }}</td>
        <td>{{ $c->statususuario }}</td>
        <td>
            <button type="button" class="btn btn-info" data-myid="{{ $c->id }}" data-mynome="{{ $c->nome }}" 
                data-myemail="{{ $c->email }}" data-mysenha="{{ $c->senha }}" data-mytipousuario="{{ $c->tipousuario }}" 
                data-mynomeusuario="{{ $c->nomeusuario }}" 
                data-toggle="modal" data-target="#editarusuario">Editar</button>

            @if($c->statususuario=='1')       
            <button type="button" class="btn btn-danger" data-myid="{{ $c->id }}" data-mystatususuario="{{ $c->statususuario }}" 
                data-toggle="modal" data-target="#inativar">Inativar</button>
            @else
            <button type="button" class="btn btn-danger" data-myid="{{ $c->id }}" data-mystatususuario="{{ $c->statususuario }}" 
                data-toggle="modal" data-target="#ativar">Ativar</button>
            @endif

        </td>
    </tr>
    @endforeach
</table>

@endif
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#incluirusuario">
  Novo
</button>
<!-- Modal -->
<div class="modal fade" id="incluirusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Incluir Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <form class="form" action="/usuarios/adiciona" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="statususuario" value="1">
                    <label>Nome</label>
                    <input name="nome" class="form-control" type="text" value="">
                    <label>E-mail</label>
                    <input name="email" class="form-control" type="text" value="">
                    <label>Senha</label>
                    <input name="senha" class="form-control" type="text" value="">
                    <label>Nome de Usuário</label>
                    <input name="nomeusuario" class="form-control" type="text" value="">
                    </br>
                    <label>Perfil:</label>
                    <label><input type="radio" name="tipousuario" value="Administrador" checked> Administrador</label>
                    <label><input type="radio" name="tipousuario" value="Educador"> Educador</label>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- Modal para edição -->
<div class="modal fade" id="editarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="form" action="/usuarios/edita" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="id" id="id" type="text" value="">
                    
                    <label>Nome</label>
                    <input name="nome" id="nome" class="form-control" type="text" value="">
                    <label>E-mail</label>
                    <input name="email" id="email" class="form-control" type="text" value="">
                    <label>Senha</label>
                    <input name="senha" id="senha" class="form-control" type="text" value="">
                    <label>Nome de Usuário</label>
                    <input name="nomeusuario" id="nomeusuario" class="form-control" type="text" value="">
                    </br>
                    <label>Perfil:</label>
                    <label><input type="radio" name="tipousuario" id="adm" value="Administrador"> Administrador</label>
                    <label><input type="radio" name="tipousuario" id="edu" value="Educador"> Educador</label>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Mudanças</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal inativar -->
<div class="modal fade" id="inativar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="exampleModalCenterTitle">Atenção!!!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form action="/usuarios/inativa" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="id" id="id" type="text" value="">

                    <h5>Você tem certeza que deseja realmente inativar este usuário?</h5>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Inativar</button>
            
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
</div>

<!-- Modal ativar -->
<div class="modal fade" id="ativar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="exampleModalCenterTitle">Atenção!!!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form action="/usuarios/ativa" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="id" id="id" type="text" value="">

                    <h5>Você tem certeza que deseja realmente ativar este usuário?</h5>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Ativar</button>
            
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
</div>
@stop