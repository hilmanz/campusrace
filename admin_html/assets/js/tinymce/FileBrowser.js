function FileBrowser (field_name, url, type, win) {
    if (type == 'file') {
        var chooser = new FileChooser({
            width: 515,
            height: 400
        });
        
        chooser.show(field_name, function(el, data) {
            // insert information now
            win.document.getElementById(el).value = data;
        });
    } else if (type == 'image') {
        var chooser = new ImageChooser({
            width: 515,
            height: 400
        });
        
        chooser.show(field_name, function(el, data) {
            // insert information now
            win.document.getElementById(el).value = data;
            
            // for image browsers: update image dimensions
            if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
            if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(data);
        });
    }
    
    return false;
}  