function notify(text,type)
{
    new Noty({
        text,
        type,
        theme:"metroui",
        timeout:3500,
        progressBar:true,
    }).show();
    
}

