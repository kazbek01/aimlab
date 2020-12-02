
function getStreamInfo(stream_id){
    $('.ajax-loader').fadeIn(100);

    $.ajax({
        url:'/admin/stream/info',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            stream_id: stream_id,
        },
        success: function (data) {
            $('.ajax-loader').fadeOut(100);
            if(data.status == 0){
                showError(data.error);
                return;
            }

            $('.conference-side-body').prepend(data);
        }
    });
}

function deleteStream(ob,stream_id) {
    if(confirm('Действительно хотите удалить?')){
        $('.ajax-loader').fadeIn(100);
        $.ajax({
            url:'/admin/stream',
            type: 'DELETE',
            data: {
                stream_id: stream_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('.ajax-loader').fadeOut(100);
                if(data.status == 0){
                    showError(data.error);
                    return;
                }
                $(ob).closest('.stream-item').remove();
            }
        });
    }
}

function showStreamEditModal(stream_id){
    $('.ajax-loader').fadeIn(100);

    $.ajax({
        url:'/admin/stream/edit',
        type: 'POST',
        data: {
            stream_id: stream_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('.ajax-loader').fadeOut(100);
            if(data.status == 0){
                showError(data.error);
                return;
            }
            $('#modal_list').html(data);
        }
    });
}

var g_stream_url = '';
var g_stream_room = '';
var g_stream_id = '';

function createStream(stream_id){
    $('.ajax-loader').fadeIn(100);

    $.ajax({
        url:'/admin/stream/check',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            stream_id: stream_id,
            stream_name: $('#stream_name').val(),
            grade: $('#grade').val(),
            grade_type: $('#grade_type').val()
        },
        success: function (data) {
            $('.ajax-loader').fadeOut(100);
            if(data.status == 0){
                showError(data.error);
                return;
            }

            if(stream_id == 0){
                getStreamInfo(data.stream_id);
                g_stream_url = data.stream_url;
                g_stream_room = data.stream_room;
                showStream();
                $('#stream_url').val(g_stream_url);
                $('#stream_url_content').fadeIn();
                $('#video_btn').fadeOut();
            }
            else {
                $('.stream_' + stream_id).replaceWith(data);
            }

            $('#stream-info').modal('hide');


        }
    });
}

var g_user_name = '';

function showStream() {
    var api;
    var domain = 'meet.jit.si';
    //var domain = 'jitsi.todaysoft.kz';

    $('#jitsi-meet').html('');
    $('#jitsi-meet').removeClass('search-teacher-body');

    var options = {
        roomName: g_stream_room,
        parentNode: document.querySelector('#jitsi-meet'),
        configOverwrite: {
            defaultLanguage: 'ru',
        },
        interfaceConfigOverwrite: {
            SHOW_JITSI_WATERMARK: false,
            JITSI_WATERMARK_LINK: '',
            SHOW_WATERMARK_FOR_GUESTS: false,
            SHOW_CHROME_EXTENSION_BANNER: false,
            DEFAULT_REMOTE_DISPLAY_NAME: 'Пользователь',
            DEFAULT_LOCAL_DISPLAY_NAME: 'Я',
            TOOLBAR_BUTTONS: [
              /*  'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
                'e2ee'**/
                'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                'fodeviceselection', 'hangup', 'profile', 'chat','sharedvideo','tileview',
                'etherpad', 'settings', 'raisehand',
                'videoquality', 'filmstrip', 'feedback', 'stats',
                'tileview', 'download', 'mute-everyone'
            ],
        }
    };
    api = new JitsiMeetExternalAPI(domain, options);
    let totalTime = 0;
    /*let timerId = setInterval(function(){
        if(api && api.getNumberOfParticipants() > 1) {
            totalTime += 1;
        }
    }, 1000);*/

    api.executeCommand('displayName', g_user_name);
    api.executeCommand('subject', g_user_name);
    api.addEventListener('videoConferenceLeft', function(){
        api.dispose();
        clearInterval(timerId);
        //$('#call-info').html("Время:" + totalTime + ", Ид препода: " + 102 + " Ид ученика: " + 58);
    });
}

function copyText(text) {
    var input = document.createElement('textarea');
    input.innerHTML = text;
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);
    showMessage($('#success_label').val());
    return result;
}

function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
        showMessage($('#success_label').val());
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
}
function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function() {
        console.log('Async: Copying to clipboard was successful!');
        showMessage($('#success_label').val());
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
}

$('#copy_btn').click(function () {
    copyTextToClipboard($('#stream_url').val());
});

function continueStream(ob,stream_url,stream_room) {
    g_stream_url = stream_url;
    g_stream_room = stream_room;
    showStream();
}
