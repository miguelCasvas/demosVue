function findById(items, id){

    for(var i in items){
        if (items[i].id == id)
            return items[i];
    }

    return null;
}

Vue.filter('category', function (id) {
    var category = findById(this.categories, id);
    return (category === null) ? 'Sin categoria' : category.name;
});

Vue.component('select-category', {
    template: '#select_category_tpl',
    props: ['categories', 'id']
});

Vue.component('note-row', {
    template: '#note_row_tpl',
    props: ['categories', 'note'],
    data: function(){
        return {
            editing: false,
            errors: []
        };
    },
    methods: {
        mDelete: function(){
            this.$parent.notes.$remove(this.note)
        },
        mEdit: function(){
            this.editing = true;
        },
        mUpdate: function(){
            this.errors = [];

            var vm = this;

            $.ajax({
                url : '/api/v1/notes/' + this.note.id,
                method: 'PUT',
                dataType: 'json',
                data: this.note,
                success: function(data){
                    vm.notes.set(vm.notes.indexOf(vm.note), data.note);
                },
                errors: function (jqXHR) {
                    vm.errors = jqXHR.responseJSON.errors;
                }
            });

            this.editing = false;
        }
    }
});


var vm = new Vue({
    el: 'body',
    data: {
        notes : [],
        new_note : {
            note: '',
            category_id: ''
        },
        categories: [
            {id: 1, name: 'Laravel'},
            {id: 2, name: 'Vue.js'},
            {id: 3, name: 'Publicidad'},
        ],
        errors: []
    },
    filters : { },
    ready: function (){

        $.getJSON('/api/v1/lists-notes-and-categories', [], function(content){
            data = content.data;

            vm.notes = data.notes;
            vm.categories = data.categories;
        });

    },
    methods: {
        createNote: function(){

            this.errors = [];

            $.ajax({
                url : '/api/v1/notes',
                method: 'POST',
                data: this.new_note,
                dataType : 'json',
                success : function(response){
                    vm.notes.push(response.note);
                },
                error: function(jqXHR){
                    vm.errors = jqXHR.responseJSON.errors;
                }
            });

            this.new_note = { note: '', category_id : ''};
        }
    }
});