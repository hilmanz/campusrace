doCallback: function() {
		var selectedNode = this.view.getSelectedNodes()[0];
		var lookup = this.lookup;
		var callback = this.callback;
		var el = this.el;
		
		this.popup.close();	//this solve the problem	

		//this.popup.hide(this.showEl, function() {
			if (selectedNode && callback) {
				var data = lookup[selectedNode.id].web_path;
				callback(el, data);

			}
		//});
	}
};