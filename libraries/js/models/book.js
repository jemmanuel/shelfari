//	/libraries/js/models/book.js

//	namespace
var app = app || {};

app.Book = Backbone.Model.extend({
	defaults: {
		author: "--some author that i will enter later--",
		status: false
	},

	validate: function(attr, options){
		if( !attr.title || attr.title === "" )
			return "Please provide valid title!!";
	}
});