$(document).ready(function(){


    var CleanObject = function(obj){
        objNew = new Object;
            $.each(obj, function(i, val) {
                if(val!="" && val!=undefined){
                    objNew[i] = val;
                }
            });
        return objNew;
    }

    function SendEntry(){
        ks            = $('input[name=ks]').val();
        uploadTokenId = $('input[name=uploadTokenId]').val();
        title         = $('input[name=title]').val();
        desc          = $('textarea[name=desc]').val();
        tags          = $('input[name=tags]').val();
        cat           = $('input[name=cat]').val();
        mediaType     = 1;

        $.post("http://kmc.smartcast.com.mx/api_v3/?service=media&action=addfromuploadedfile&format=1",
        CleanObject({
            'ks'            : ks,
            'uploadTokenId' : uploadTokenId,
            'mediaEntry:mediaType' : mediaType,
            'mediaEntry:name' : title,
            'mediaEntry:description' : desc,
            'mediaEntry:tags' : tags,
            'mediaEntry:categoriesIds' : cat,
        }),
        function(data){
            console.log(data);
        });
    }

    var options = {
        beforeSubmit : function(){

            if($('input[name=fileData]').val().length < 1){
                return false;
            }

        },
        beforeSend: function() 
        {
            $("#progress").show();
            //clear everything
            $("#bar").width('0%');
            $("#message").html("");
            $("#percent").html("0%");

        },
        uploadProgress: function(event, position, total, percentComplete) 
        {
            // $('.bar5').KrakenTrigger('Progress', { progress : percentComplete } );
            console.log(percentComplete);
        },
        success: function() 
        {
            // $('.bar5').KrakenTrigger('Progress', { progress : 100 } );

        },
        complete: function(response) 
        {
            SendEntry();
        },
        error: function()
        {
            $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
        }
    }; 

     $("#myForm").ajaxForm(options);

});