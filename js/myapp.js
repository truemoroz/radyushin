var app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data: () => ({
        authorsHeader: [
            {
                text: 'Имя',
                value: 'name',
                width: 100,
            },
            {
                text: 'Рейтинг',
                value: 'rating',
                width: 100,
            },
            {
                text: 'Количество книг',
                value: 'book_qty',
                width: 100,
            },
            {
                text: 'Удалить',
                value: 'action',
                width: 100,
                sortable: false
            },
            {
                text: 'Похожие авторы',
                value: 'show-authors',
                width: 100,
                sortable: false
            }
        ],
        genresHeader: [
            {
                text: 'Жанр',
                value: 'title',
                width: 100,
            },
            {
                text: 'Удалить',
                value: 'action',
                width: 100,
            },
            {
                text: '',
                value: 'data-table-expand',
                width: 100,
            },
        ],
        booksHeader: [
            {
                text: 'Название',
                value: 'book_title',
                width: 100,
            },
            {
                text: 'Автор',
                value: 'name',
                width: 100,
            },
            {
                text: 'Жанр',
                value: 'genre_title',
                width: 100,
            },
            {
                text: 'Рейтинг',
                value: 'rating',
                width: 100,
            },
            {
                text: 'Удалить',
                value: 'action',
                width: 100,
            }
        ],
        similarAuthorsHeaders: [
            {
                text: 'Автор',
                value: 'name',
                width: 100,
            },
        ],
        genreAuthorsHeader: [
            {
                text: 'Имя',
                value: 'name',
                width: 100,
            },
            {
                text: 'Рейтинг',
                value: 'rating',
                width: 100,
            },
        ],
        expanded: [],
        authors: [],
        genres: [],
        books: [],
        genreAuthors: [],
        selectedItems: [],
        dialogAuthor: false,
        dialogGenre: false,
        dialogBook: false,
        similarAuthorsDialog: false,
        newAuthor: {
            name: '',
        },
        newGenre: {
            title: '',
        },
        newBook: {
            book_title: '',
            author_id: 0,
            genre_id: 0,
            rating: 0,
        },
        editedBook: {
            book_title: '',
            author_id: 0,
            genre_id: 0,
            rating: 0,
        },
        editedIndex: -1,
        similarAuthors: []

    }),
    created() {
        this.getApiData();
    },
    computed: {
        formBookTitle() {
            return this.editedIndex === -1 ? 'Добавление книги' : 'Редактирование книги';
        },
    },
    watch: {
        dialog(val) {
            val || this.close()
        },
    },

    methods: {
        getApiData: function () {
            fetch('/radyushin/api/getAuthors.php/')
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    }

                    throw new Error('Network response was not ok');
                })
                .then((json) => {
                    if (json) {
                        this.authors = [];
                        json.forEach(author => {
                            this.authors.push(author);
                        });
                        this.totalRecords = json.totalRecords;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });

            fetch('/radyushin/api/getGenres.php/')
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    }

                    throw new Error('Network response was not ok');
                })
                .then((json) => {
                    if (json) {
                        this.genres = [];
                        json.forEach(genre => {
                            this.genres.push(genre);
                        });
                        this.totalRecords = json.totalRecords;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });

            fetch('/radyushin/api/getBooks.php/')
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    }

                    throw new Error('Network response was not ok');
                })
                .then((json) => {
                    if (json) {
                        this.books = [];
                        json.forEach(book => {
                            this.books.push(book);
                        });
                        this.totalRecords = json.totalRecords;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        saveAuthor: function (author) {

            // console.log(author);
            let params = new URLSearchParams();
            params.append('id', author.item.id);
            params.append('name', author.item.name);
            axios.post('/radyushin/api/saveAuthor.php/', params)
                .then(response => {
                })
                .catch(error => {
                })
        },

        newAuthorSave: function () {
            let params = new URLSearchParams();
            // params.append('id', author.item.id);
            params.append('name', this.newAuthor.name);
            axios.post('/radyushin/api/addAuthor.php/', params)
                .then(response => {
                    this.getApiData();
                    this.dialogAuthor = false;
                    this.newAuthor.name = '';
                })
                .catch(error => {
                })
        },
        newGenreSave: function () {
            let params = new URLSearchParams();
            params.append('title', this.newGenre.title);
            axios.post('/radyushin/api/addGenre.php/', params)
                .then(response => {
                    this.getApiData();
                    this.dialogGenre = false;
                })
                .catch(error => {
                })
        },
        newBookSave: function () {
            // console.log(this.newBook);
            // this.desserts.push(this.editedItem)
            let params = new URLSearchParams();
            params.append('title', this.editedBook.book_title);
            params.append('author_id', this.editedBook.author_id);
            params.append('genre_id', this.editedBook.genre_id);
            params.append('rating', this.editedBook.rating);

            if (this.editedIndex > -1) {
                // редактирование книги
                params.append('id', this.editedBook.id);
                axios.post('/radyushin/api/updateBook.php/', params)
                    .then(response => {
                        this.getApiData();
                        this.dialogBook = false;
                        this.editedBook = this.newBook;
                        this.editedIndex = -1;
                    })
                    .catch(error => {
                    })
            } else {
                axios.post('/radyushin/api/addBook.php/', params)
                    .then(response => {
                        this.getApiData();
                        this.dialogBook = false;
                        this.editedBook = this.newBook;
                    })
                    .catch(error => {
                    })
            }

            // this.close();
        },
        close() {
            this.dialogAuthor = false;
            this.dialogGenre = false;
            this.dialogBook = false;

            this.editedBook = this.newBook;
            this.editedIndex = -1;

        },

        deleteAuthor: function (author) {
            let params = new URLSearchParams();
            params.append('id', author.id);
            // params.append('name', author.item.name);
            axios.post('/radyushin/api/delAuthor.php/', params)
                .then(response => {
                    this.getApiData();
                })
                .catch(error => {
                })
        },

        deleteGenre: function (genre) {
            let params = new URLSearchParams();
            params.append('id', genre.id);
            axios.post('/radyushin/api/delGenre.php/', params)
                .then(response => {
                    this.getApiData();
                })
                .catch(error => {
                })
        },

        editBook(item) {
            this.editedIndex = this.books.indexOf(item);
            this.editedBook = Object.assign({}, item);
            // this.editedBook.currentAuthor = {name: this.editedBook.name, id: this.editedBook.author_id};
            this.dialogBook = true;
        },

        expandGenre: function (genre) {

            // console.log(genre);
            let params = new URLSearchParams();
            params.append('id', genre.id);
            this.expanded = [];
            this.expanded.push(genre);

            axios.post('/radyushin/api/getGenreAuthors.php/', params)
                .then(response => {
                    if (response) {
                        this.genreAuthors = [];
                        response.data.forEach(author => {
                            this.genreAuthors.push(author);
                        });
                        // this.totalRecords = response.totalRecords;
                    }
                })
                .catch(error => {
                });
        },

        showSimilarAuthor: function (author) {
            // console.log(author.item.id);
            let params = new URLSearchParams();
            params.append('id', author.item.id);
            axios.post('/radyushin/api/getSimilarAuthors.php/', params)
                .then(response => {
                    if (response) {
                        // return response.json();
                        this.similarAuthors = [];
                        response.data.forEach(author => {
                            this.similarAuthors.push(author);
                        });
                        // response.data.forEach(author => {
                        //     this.similarAuthors.push(author.name.json());
                        // });
                        // this.totalRecords = response.totalRecords;
                    }
                })
                .catch(error => {
                });
        }
    }
});
