// /libraries/js/collections/library.js

//	namespace
var app = app || {};

app.Library = Backbone.Collection.extend({
	model: app.Book,

	comparator: function(a, b){
		if(a.get("status") < b.get("status"))
			return -1;
		else if(a.get("status") > b.get("status"))
			return 1;
		else if(a.get("status") === b.get("status"))
			return a.get("title").localeCompare(b.get("title"));
	},

	add: function(books, options){
		var validModels = [];

		if(!_.isArray(books))
			books = [books];


		if(options.unique){
			_.each(books, function(newBook){

				if(!_.any( this.toJSON(), function(oldBook){	return oldBook.title === newBook.title; } ))
					validModels.push(newBook);

			}, this);
		}else{
			validModels = books;
		}

		return Backbone.Collection.prototype.add.call(this, validModels, options);
	},

	create: function(book, options){
		if(options.unique){
			if(!_.any( this.toJSON(), function(oldBook){	return oldBook.title === book.title; } )){
				return Backbone.Collection.prototype.create.call(this, book, options);
			}
		}
	},

	filter: function(filter){

		var filterRegExp = new RegExp(filter+".*", "im");

		this.each(function(item){
			if( !filterRegExp.test(item.get('title')) )
				item.view.$el.hide();
			else
				item.view.$el.show();
		});
	},

	url: '/books'
});
