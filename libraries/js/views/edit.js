//	/libraries/js/views/edit.js

//	namespace
app = app || {};

app.Edit = Backbone.View.extend({
	el: '#myModal',

	events: {
		'click #saveChanges': 'updateModel',
		'click #closeModal': 'unbindEvents'
	},

	initialize: function(item){
		this.model = item;
		this.render();
	},

	render: function(){
		this.$el.modal('show');
	},

	unbindEvents: function(e){
		this.undelegateEvents();
		this.stopListening();
		console.log(e.currentTarget);
	},

	updateModel: function(){
		var updates = {};
		this.$('input').each(function(i, el){
			if($(el).val() !== ''){
				updates[el.id] = $(el).val();
				$(el).val("");
			}
		});

		this.model.save(updates);
		this.$('#closeModal').click();
	}
});