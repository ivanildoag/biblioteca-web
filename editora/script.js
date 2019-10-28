Vue.filter('reais', v => `R$ ${Number(v).toFixed(2)}`)

new Vue({
	el: "#app",
	data() {
		return {
			editoras: [],
			addDialog: false,
			editDialog: false,
			busca: '',
			nome: '',
			id: '',
			loading: false
		}
	},
	mounted() {
		this.listar()
	},
	methods: {
		listar(busca = null) {
			this.loading = true
			axios.get('./buscar.php', {
				params: {
					busca
				}
			}).then(response => {
				this.editoras = response.data
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
		adicionar() {
			const formData = new FormData()
			formData.append('nome', this.nome)
			this.loading = true
			axios.post('./cadastrar.php', formData).then(() => {
				this.listar()
				this.addDialog = false
			}).finally(() => {
				this.loading = false
			})
		},
		abrirAdicionarPopup() {
			this.reset()
			this.addDialog = true
		},
		abrirEditarPopup(editora) {
			this.id = editora.id
			this.nome = editora.nome
			this.editDialog = true
		},
		editar() {
			const formData = new FormData()
			formData.append('nome', this.nome)
			this.loading = true
			axios.post('./alterar.php', formData, { params: { id: this.id } }).then(() => {
				this.listar()
				this.editDialog = false
			}).finally(() => {
				this.loading = false
			})
		},
		reset() {
			this.nome = ''
		}
	}
})