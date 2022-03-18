class App
{
    #canLog = false;

    #acoes = {
        'login': async (data) => this.#acao_logar(data),
        'logout': async () => this.#acao_deslogar(),
    };

    #links = {
        'access_token': 'http://poc.saml.sp-b/access_token/',
    };

    constructor() {
        this.#carregarLog();
        this.#mostrarUsuario();
        this.#processarAcoesRecebidas();
        this.#bindEvents();
    }

    /**
     * Recebe ações da url
     */
    async #processarAcoesRecebidas()
    {
        const search = window.location.search;

        if(search) {
            this.#canLog = true;

            const query = new URLSearchParams(search);

            const acao = query.get('acao');
            const data = query.get('data');

            if(acao && this.#acoes.hasOwnProperty(acao)) {
                
                if(data) {
                    await this.#acoes[acao](data);
                } else {
                    await this.#acoes[acao]();
                }

                this.#mostrarUsuario();
                this.#mostrarAccessToken();
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
     * Mostra o access token
     */
    async #mostrarAccessToken()
    {
        if(localStorage.getItem('access_token')) {
            let access_token = JSON.parse(localStorage.getItem('access_token'));
            access_token = JSON.stringify(access_token,null,4);

            $("#access_token").html(access_token);
        } else {
            $("#access_token").html("Não gerado");
        }
    }

    /**
     * Ações dinâmicas
     */
    async #acao_logar(dadosJson)
    {
        try{
            localStorage.setItem('user', atob(dadosJson));

            this.registrarLog("Login com sucesso");
        }catch(e){}
    }

    async #acao_deslogar()
    {
        try{
            localStorage.removeItem('user');

            this.registrarLog("Deslogado");
        }catch(e){}
    }

    async #carregarLog()
    {
        $("#log")
            .html(localStorage.getItem('logStack'))
            .parent()
            .scrollTop(500000);
    }

    async registrarLog(mensagem)
    {
        if(!this.#canLog) return false;

        const date = new Date;

        var out = `[${date.getDate()}/${date.getMonth()}/${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds() < 10 ? '0'+date.getSeconds() : date.getSeconds()}] ${mensagem}`;

        const fullContent = $("#log").html() + '\n' + out + '\n';

        localStorage.setItem('logStack', fullContent);

        this.#carregarLog();
    }

    async #bindEvents()
    {
        $("#novoAccessToken").bind('click', () => this.#gerarNovoAccessToken());
    }

    async #gerarNovoAccessToken()
    {
        var frame = $("<iframe>");
        
        frame.attr('src', this.#links.access_token);
        frame.hide();

        frame.bind('load', (e) => {
            const token = Cookies.get('access_token');

            localStorage.setItem('access_token', token);

            Cookies.remove('access_token');

            this.#mostrarAccessToken();
        });

        frame.appendTo('body');
    }
}