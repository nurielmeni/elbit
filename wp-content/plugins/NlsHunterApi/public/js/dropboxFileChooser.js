Dropbox.init({
    appKey: 'i0wov2z8p3ga62p',
    id: 'dropboxjs'
});

dropboxOptions = {

    // Required. Called when a user selects an item in the Chooser.
    success: function(files) {
        jQuery('.nls-apply-for-jobs.modal form input[name="dropbox"]').val(files[0].link);
        jQuery('.nls-apply-for-jobs.modal form input[name="fileName"]').val(files[0].name);
        console.log("Dropbox File Picked: " + files[0].link);
    },

    // Optional. Called when the user closes the dialog without selecting a file
    // and does not include any parameters.
    cancel: function() {

    },

    // Optional. "preview" (default) is a preview link to the document for sharing,
    // "direct" is an expiring link to download the contents of the file. For more
    // information about link types, see Link types below.
    linkType: "direct", //"preview" or "direct"

    // Optional. A value of false (default) limits selection to a single file, while
    // true enables multiple file selection.
    multiselect: false, // or true

    // Optional. This is a list of file extensions. If specified, the user will
    // only be able to select files with these extensions. You may also specify
    // file types, such as "video" or "images" in the list. For more information,
    // see File types below. By default, all extensions are allowed.
    extensions: ['.pdf', '.doc', '.docx', '.rtf'],

    // Optional. A value of false (default) limits selection to files,
    // while true allows the user to select both folders and files.
    // You cannot specify `linkType: "direct"` when using `folderselect: true`.
    folderselect: false, // or true
};