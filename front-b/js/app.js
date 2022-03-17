"use strict";

class App
{
    #acoes = {
        'login': async (data) => this.#acao_logar(data),
        'logout': async () => this.#acao_deslogar(),
    };

    constructor() {
        this.#mostrarUsuario();
        this.#processarAcoesRecebidas();
    }

    /**
     * Recebe ações da url
     */
    async #processarAcoesRecebidas()
    {
        const search = window.location.search;

        if(search) {
            const query = new URLSearchParams(search);

            const acao = query.get('acao');
            const data = query.get('data');

            console.log(acao, data);

            if(acao && this.#acoes.hasOwnProperty(acao)) {
                await this.#acoes[acao](data);
                this.#mostrarUsuario();
            }
        }
    }

    /**
     * Mostra os dados do usuário armazenados
     */
    async #mostrarUsuario()
    {
        if(localStorage.getItem('user')) {
            let user = JSON.parse(localStorage.getItem('user'));
            user = JSON.stringify(user,null,4);

            $("#usuario").html(user);
        } else {
            $("#usuario").html("Não logado");
        }
    }

    /**
     * Ações dinâmicas
     */
    async #acao_logar(dadosJson)
    {
        try{
            localStorage.setItem('user', atob(dadosJson))
        }catch(e){}
    }

    async #acao_deslogar()
    {
        try{
            localStorage.removeItem('user')
        }catch(e){}
    }
}