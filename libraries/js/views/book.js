//	/libraries/js/views/book.js

//	namespace
var app = app || {};

app.BookView = Backbone.View.extend({
	//	parent element to insert into table
	tagName: 'tr',
	//	micro-template to read structure
	bookTemplate: _.template( $('#bookTemplate').html() ),
	//	event handling
	events: {
		'click .delete': 'destroyBook',
		'click .edit': 'editBook',
		'click .toggle': 'toggleStatus'
	},
	initialize: function(){
		//	listen for change in status and model destruction
		this.listenTo(this.model, 'change destroy', this.removeView);
		this.model.view = this;
	},
	destroyBook: function(e){
		//	remove model from collection
		this.model.destroy();
	},
	editBook: function(){
		new app.Edit(this.model);
	},
	//	deal with change / destroy event by removing view
	removeView: function(e){
		this.remove();
	},
	//	function to render individual book model
	render: function(){
		//	render html to be placed in 'tr' element
		this.$el.html( this.bookTemplate( this.model.toJSON() ) );
		this.model.get('status')?this.$el.addClass('muted'):this.$el.removeClass('muted');
		//	for chaining
		return this;
	},
	//	toggle status setting off change:status event
	toggleStatus: function(e){
		this.model.save('status',this.model.get('status')?false:true);
	}
});