//	/libraries/js/views/library.js

//	namespace
var app = app || {};

app.LibraryView = Backbone.View.extend({
	//	append to table body
	el: '#booksContainer',
	//	add event listening to add elements
	events: {
		'click #addNew': 'addBook',
		'keyup #filterText': 'filterCollection',
		'click #reset': 'resetFilter'
	},
	//	on startup get all books
	initialize: function(){
		//	to insert new books
		this.$table = this.$('#tableBody');

		this.collection = new app.Library();
		//	initial collection
		this.collection.fetch({validate: true, reset: true});
		//	listen to additions in collection
		this.listenTo(this.collection, 'add', this.renderBook);
		//	listen to changes in status of a book model
		this.listenTo(this.collection, 'change', this.reRenderBook);
		//	listen to collection reset i.e page refresh
		this.listenTo(this.collection, 'reset', this.render);
	},

	filterCollection: function(e){
		var filter = $('#filterText').val();
		this.collection.filter(filter);
		return false;
	},

	resetFilter: function(e){
		$('#filterText').val("");
		this.filterCollection();
		return false;
	},

	render: function(){
		this.$table.empty();
		// increase performance by reducing DOM reflow
		var fragment = document.createDocumentFragment();
		this.collection.each(function(item){
			//	without passing context 'this' refers to individual model in collection which does not have el property
			fragment.appendChild( new app.BookView({model:item}).render().el );
		},this);
		this.$table.append( fragment );
	},

	// render each book in its sorted place
	renderBook: function(item){
		var index = this.collection.indexOf(item);
		var rendered = new app.BookView({model: item}).render().el;
		index > 0 ? $('#tableBody > tr').eq(index-1).after( rendered ) : $('#tableBody').prepend( rendered );
	},

	reRenderBook: function(item){
		this.collection.sort();
		this.renderBook(item);
	},

	// add a new book - doesn't remove duplicates
	addBook: function(e){

		var bookData = {};
		// in case we need to add more fields
		$('#addBook').children('input').each(function(i, el){
			if($( el ).val() !== ''){
				bookData[el.id] = $( el ).val().trim();
				$( el ).val("");
			}
		});
		bookData['status'] = ( $('#status').val() == "true"?true:false );

		this.collection.create(bookData, {validate: true, unique: true});
		//	prevent default behaviour
		return false;
	}

});