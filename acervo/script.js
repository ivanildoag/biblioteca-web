Vue.filter('reais', v => `R$ ${Number(v).toFixed(2)}`)

new Vue({
	el: "#app",
	data() {
		return {
			acervos: [],
			editoras: [],
			idEditora: null,
			busca: '',
			titulo: '',
			autor: '',
			ano: '',
			preco: '',
			quantidade: '',
			tipo: '',
			addDialog: false,
			editDialog: false,
			id: null,
			loading: false
		}
	},
	mounted() {
		this.obterEditoras()
		this.listar()
	},
	methods: {
		adicionar() {
			const formData = new FormData()
			formData.append('idEditora', this.idEditora)
			formData.append('titulo', this.titulo)
			formData.append('autor', this.autor)
			formData.append('ano', this.ano)
			formData.append('preco', this.preco)
			formData.append('quantidade', this.quantidade)
			formData.append('tipo', this.tipo)
			this.loading = true
			axios.post('./cadastrar.php', formData).then(() => {
				this.listar()
				this.addDialog = false
			}).finally(() => {
				this.loading = false
			})
		},
		editar() {
			const formData = new FormData()
			formData.append('idEditora', this.idEditora)
			formData.append('titulo', this.titulo)
			formData.append('autor', this.autor)
			formData.append('ano', this.ano)
			formData.append('preco', this.preco)
			formData.append('quantidade', this.quantidade)
			formData.append('tipo', this.tipo)
			this.loading = true
			axios.post('./alterar.php', formData, { params: { id: this.id } }).then(() => {
				this.listar()
				this.editDialog = false
			}).finally(() => {
				this.loading = false
			})
		},
		listar(busca = null) {
			this.loading = true
			axios.get('./buscar.php', {
				params: {
					busca
				}
			}).then(response => {
				this.acervos = response.data
			}).finally(() => {
				this.loading = false
			})
		},
		deletar(id) {
			this.loading = true
			axios.get('./deletar.php', {
				params: {
					id
				}
			}).then(() => {
				this.listar()
			}).finally(() => {
				this.loading = false
			})
		},
		obterEditoras() {
			this.loading = true
			axios.get('../editora/buscar.php').then(response => {
				this.editoras = response.data
			}).finally(() => {
				this.loading = false
			})
		},
		reset() {
			this.idEditora = null
			this.titulo = ''
			this.autor = ''
			this.ano = ''
			this.preco = ''
			this.quantidade = ''
			this.tipo = ''
		},
		abrirAdicionarPopup() {
			this.reset()
			this.addDialog = true
		},
		abrirEditarPopup(acervo) {
			this.id = acervo.id
			this.idEditora = acervo.idEditora
			this.titulo = acervo.titulo
			this.autor = acervo.autor
			this.ano = acervo.ano
			this.preco = acervo.preco
			this.quantidade = acervo.quantidade
			this.tipo = acervo.tipo
			this.editDialog = true
		}
	}
})