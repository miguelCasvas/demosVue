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
            editing: false
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
            this.editing = false;
        }
    }
});


var vm = new Vue({
    el: 'body',
    data: {
        notes : [
            {
                note: 'Laravel 5.1 es LTS',
                category_id : 1
            },
            {
                note: 'v-for es la directiva que utilizamos para iterar una lista',
                category_id : 2
            },
            {
                note: '@click se utiliza como un alias de v-on:click',
                category_id : 2
            },
            {
                note: 'clase demo',
                category_id : 3
            },
        ],
        new_note : {
            note: '',
            category_id: ''
        },
        categories: [
            {id: 1, name: 'Laravel'},
            {id: 2, name: 'Vue.js'},
            {id: 3, name: 'Publicidad'},
        ]
    },
    filters : { },
    methods: {
        createNote: function(){
            this.notes.push(this.new_note);
            this.new_note = { note: '', category_id : ''};
        }
    }
});