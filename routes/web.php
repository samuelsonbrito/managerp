<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // HOME/DASHBOARD
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('/');
    Route::get('/home/conselhos-prestes-a-vencer', 'HomeController@conselhosPrestesVencer')->name('conselhos.prestes.vencer');
    Route::get('/home/conselhos-vencidos', 'HomeController@conselhosVencidos')->name('conselhos.vencidos');
    Route::get('/home/alerta-ferias-colaboradores', 'HomeController@alertaFeriasColaboradores')->name('alerta.ferias.colaboradores');
    Route::get('/home/imprimir-conselhos-vencidos', 'HomeController@imprimirConselhosVencidos')->name('imprimir.conselhos.vencidos');
    Route::get('/home/imprimir-conselhos-prestes-vencer', 'HomeController@imprimirConselhosPrestesVencer')->name('imprimir.conselhos.prestes.vencer');
    Route::get('/home/imprimir-alerta-ferias', 'HomeController@imprimirAlertaFerias')->name('imprimir.alerta.ferias');

    Route::group(['namespace'=>'Admin'],function(){
        Route::resource('admin','AdministradorController');
        Route::get('admin/perfil/index','AdministradorController@perfilIndex')->name('admin.perfil');
        Route::post('admin/perfil/salvar-perfil','AdministradorController@salvarPerfil')->name('admin.perfil.salvar-perfil');
        Route::post('admin/perfil/excluir-perfil','AdministradorController@excluirPerfil')->name('admin.perfil.excluir-perfil');
        Route::get('admin/usuario/index','AdministradorController@usuarioIndex')->name('admin.usuario');
        Route::post('admin/usuario/salvar-usuario','AdministradorController@salvarUsuario')->name('admin.usuario.salvar-usuario');
        Route::post('admin/usuario/excluir-usuario','AdministradorController@excluirUsuario')->name('admin.usuario.excluir-usuario');
        Route::get('admin/permissao-acesso/index','AdministradorController@permissaoAcesso')->name('admin.permissao-acesso');
        Route::post('admin/permissao-acesso/remover','AdministradorController@removerPermissaoAcesso')->name('admin.permissao-acesso.remover');
        Route::post('admin/permissao-acesso/adicionar','AdministradorController@adicionarPermissaoAcesso')->name('admin.permissao-acesso.adicionar');


    });
    //COLABORADORES
    Route::group(['namespace' => 'Colaborador'], function () {
        Route::resource('colaborador','ColaboradorController');
        Route::get('colaborador/imprimir/{id}', 'ColaboradorController@imprimirShow')->name('imprimir.colaborador');
        Route::post('colaborador/verifica-cpf', 'ColaboradorController@verificaCpfExistente')->name('colaborador.verifica.cpf');
        Route::get('colaborador/anexos/colaborador/{id}', 'ColaboradorController@anexos')->name('colaborador.anexos');
        Route::get('colaborador/dependentes/colaborador/{id}', 'ColaboradorController@dependentes')->name('colaborador.dependentes');
        Route::get('colaborador/licencas/colaborador/{id}', 'ColaboradorController@licencas')->name('colaborador.licencas');
        Route::get('colaborador/anexos/baixar/{id}', 'ColaboradorController@baixarAnexo')->name('colaborador.baixar.anexo');
        Route::get('colaborador/anexos/dependente/{id}', 'ColaboradorController@ajaxAnexosDependentes')->name('colaborador.anexo.dependente');
        Route::delete('colaborador/anexos/excluir/{id}', 'ColaboradorController@excluirAnexo')->name('colaborador.excluir.anexo');
        Route::delete('colaborador/dependente/excluir/{id}', 'ColaboradorController@excluirDependente')->name('colaborador.excluir.dependente');
        Route::delete('colaborador/licenca/excluir/{id}', 'ColaboradorController@excluirLicenca')->name('colaborador.excluir.licenca');
        Route::put('colaborador/anexo/editar/{id}', 'ColaboradorController@editarAnexo')->name('colaborador.editar.anexo');
        Route::put('colaborador/dependente/editar/{id}', 'ColaboradorController@editarDependente')->name('colaborador.editar.dependente');
        Route::post('colaborador/dependente/cadastrar', 'ColaboradorController@cadastrarDependente')->name('colaborador.cadastrar.dependente');
        Route::post('colaborador/licenca/cadastrar', 'ColaboradorController@cadastrarLicenca')->name('colaborador.cadastrar.licenca');
        Route::post('colaborador/anexo/cadastrar', 'ColaboradorController@cadastrarAnexo')->name('colaborador.cadastrar.anexo');
    });

    Route::group(['namespace' => 'Cliente'], function () {
        Route::resource('cliente','ClienteController');
    });

    Route::group(['namespace' => 'Unidade'], function () {
        Route::resource('unidade','UnidadeController');
    });

    Route::group(['namespace' => 'Setor'], function () {
        Route::resource('setor','SetorController');
        Route::get('setor/colaboradores/{id}', 'SetorController@gerenciarColaboradores')->name('setor.colaboradores');
        Route::get('setor/get-colaboradores/ajax', 'SetorController@getColaboradorAjax')->name('setor.colaborador.ajax');
        Route::post('setor/adicionar-colaborador/{id}', 'SetorController@adicionarColaborador')->name('setor.adicionar-colaborador');
        Route::get('setor/remover-colaborador/{colabordor_id}/{setor_id}', 'SetorController@removerColaborador')->name('setor.remover.colaborador');
    });

    Route::group(['namespace' => 'Cargo'], function () {
        Route::resource('cargo','CargoController');
    });

    Route::group(['namespace' => 'Horario'], function () {
        Route::resource('horario-trabalho','HorarioTrabalhoController');
    });

    Route::group(['namespace' => 'Horario'], function () {
        Route::resource('horario-intervalo','HorarioIntervaloController');
    });

    Route::group(['namespace' => 'Escala'], function () {
        Route::get('escala/imprimir/{id}', 'EscalaController@imprimirEscala')->name('imprimir.escala');
        Route::post('escala/excluir','EscalaController@excluirEscala')->name('escala.excluir');
        Route::get('escala/visulizar/{id}','EscalaController@visualizarEscala')->name('escala.visualizar');
        Route::get('escala/editar/{id}','EscalaController@editarEscala')->name('escala.editar');
        Route::get('escala/montar-escala','EscalaController@montarEscala')->name('escala.montar-escala');
        Route::get('escala','EscalaController@consultarEscala')->name('escala.consultar-escala');
        Route::post('escala/unidade','EscalaController@setoresUnidade')->name('escala.setores');
        Route::get('escala/montar-escala-mensal','EscalaController@montarEscalaMensal')->name('escala.montar-escala-mensal');
        Route::post('escala/cadastrar-escala','EscalaController@cadastrarEscala')->name('escala.cadastrar-escala');
        Route::get('escala/salvar-escala/{id}','EscalaController@salvarEscala')->name('escala.salvar-escala');
        Route::post('escala/salva-dia-escala', 'EscalaController@salvarDiaEscala')->name('escala.salvar-dia-escala');
        Route::get('escala/imprimir/frequencia-manual/{id}', 'EscalaController@imprimirFrequenciaManual')->name('escala.imprimir-frequencia-manual');

        Route::get('escala/imprimir/alimentacao/{id}', 'EscalaController@imprimirAlimentacao')->name('escala.imprimir-alimentacao');
    });
    Route::group(['namespace'=>'Contrato'],function () {
        Route::resource('contratos','ContratoController');
        Route::get('contratos/anexos/contrato/{numero_contrato}', 'ContratoController@anexos')->name('contrato.anexos');
        Route::post('contratos/anexo/cadastrar', 'ContratoController@cadastrarAnexo')->name('contrato.cadastrar.anexo');
        Route::delete('contratos/anexos/excluir/{id}', 'ContratoController@excluirAnexo')->name('contrato.excluir.anexo');
        Route::get('contratos/anexos/baixar/{id}', 'ContratoController@baixarAnexo')->name('contrato.baixar.anexo');
        Route::put('contratos/anexo/editar/{id}', 'ContratoController@editarAnexo')->name('contrato.editar.anexo');
        Route::post('getAllContratosValor','ContratoController@contratoWidget')->name('get.contrato.info');
    });

    Route::group(['namespace' => 'Relatorio'], function () {
        Route::resource('relatorio/colaborador-setores','RelatorioController');
        Route::get('relatorio/imprimir-relatorio-colaborador-setores/{id}', 'RelatorioController@imprimirRelatorioColaboradorSetores')->name('imprimir.relatorio.colaborador.setores');
    });

    Route::group(['namespace' => 'Feriado'], function () {
        Route::resource('feriado','FeriadoController');
    });

    Route::group(['namespace' => 'Frequencia'], function () {
        Route::get('frequencia/inicio-relatorio','FrequenciaController@inicioRelatorio')->name('frequencia.inicio-relatorio');
        Route::resource('frequencia','FrequenciaController');
        Route::get('frequencia/gerenciar-frequencia/{periodo}/{dia}/{unidade}/{turno}','FrequenciaController@gerenciarFrequencias')->name('frequencia.gerenciar-frequencias');
        Route::get('frequencia/reverter-frequencia/{id}','FrequenciaController@reverterFrequencia')->name('frequencia.reverter');
        Route::post('frequencia/gerar-frequencia','FrequenciaController@gerarFrequencia')->name('frequencia.gerar-frequencia');
        Route::post('frequencia/gerar-relatorio','FrequenciaController@gerarRelatorio')->name('frequencia.gerar-relatorio');
        Route::get('frequencia/imprimir-relatorio-frequencia/{data}/{unidade}/{turno}/{cargo}', 'FrequenciaController@imprimirRelatorio')->name('frequencia.imprimir-relatorio');
    });
});
