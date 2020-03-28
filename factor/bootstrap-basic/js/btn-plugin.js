(function () {
    tinymce.PluginManager.add('video_embed', function (editor, url) {

        // Add a button that opens a window
        editor.addButton('playbuzz_button_key', {
            text: 'add iframe',
            icon: false,
            onclick: function () {
                // Open window
                editor.windowManager.open({
                    title: 'playbuzz Embede',
                    body: [{
                            type: 'textbox',
                            name: 'title',
                            label: 'Embed Code'
                        }],
                    onsubmit: function (e) {
                        // Insert content when the window form is submitted
                        //  editor.insertContent('asdasdad')
                        editor.insertContent('<div class="videoWrapper">' + e.data.title + '</div>');
                    }

                });
            }

        }),
                editor.addButton('video_button_key', {
                    text: 'Video url',
                    icon: false,
                    onclick: function () {
                        // Open window
                        editor.windowManager.open({
                            title: 'Video Urle',
                            body: [{
                                    type: 'textbox',
                                    name: 'video_link',
                                    label: 'Video Url'
                                }],
                            onsubmit: function (e) {
                                // Insert content when the window form is submitted
                                //  editor.insertContent('asdasdad')
                                editor.insertContent('<div class="wp-video"><video id="entertrain-video" class="video-js vjs-16-9  vjs-big-play-centered" preload="auto" controls="controls" data-setup="{}"><source src="' + e.data.video_link + '" type="video/mp4" /></video></div>');
                            }

                        });
                    }

                })

    });
})();
