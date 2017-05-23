doCallback : function() {
		var row = this.grid.getSelectionModel().getSelected();
		var callback = this.callback;
		var el = this.el;
		
		this.popup.close();  //this solve the problem
		//this.popup.hide(this.showEl, function() {
			if (row && callback) {
				var data = row.data.web_path;
				callback(el, data);
			}
		//});
	}