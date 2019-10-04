@extends('layout')

@section('contentPage')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Repaso</h2>
            <table class="table table-striped">
                <tr>
                    <th>Categoría</th>
                    <th>Nota</th>
                    <th>&nbsp;</th>
                </tr>

                <tr v-for="note in notes" is="note-row" :note.sync="note" :categories="categories"></tr>
                <tr>
                    <td><select-category :categories="categories" :id.sync="new_note.category_id"></select-category></td>
                    <td>
                        <input type="text" v-model="new_note.note" class="form-control">
                        <ul v-if="errors.length" class="text-danger">
                            <li v-for="error in errors">@{{ error  }}</li>
                        </ul>
                    </td>
                    <td><a href="" @@click.prevent="createNote()">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                    </td>
                </tr>
            </table>
            <pre>@{{ $data | json}}</pre>
        </div>
    </div>
@endsection

@section('scripts')
    @verbatim
    <template id="select_category_tpl">
        <select v-model="id" class="form-control">
            <option value="">- Selección</option>
            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
        </select>
    </template>

    <template id="note_row_tpl">
        <tr>
            <template v-if="! editing">
                <td>{{ note.category_id | category }}</td>
                <td>{{ note.note }}</td>
                <td width="50px">
                    <a href="" @click.prevent="mEdit()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="" @click.prevent="mDelete()"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </template>
            <template v-else>
                <td>
                    <select-category :categories="categories" :id.sync="note.category_id"></select-category>
                </td>
                <td><input type="text" class="form-control" v-model="note.note"></td>
                <td><a href="" @click.prevent="mUpdate()"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
            </template>
        </tr>
    </template>
    @endverbatim

    <script
            src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous"></script>
    <script src="{{ url('js/vue1.js')}}"></script>
    <script src="{{ url('js/main.js')}}"></script>

@endsection