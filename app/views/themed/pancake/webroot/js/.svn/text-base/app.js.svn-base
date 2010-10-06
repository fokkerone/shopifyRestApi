$(document).ready(function(){
    // active tab should hide the shadow
    var actmen  = $('#menu li.active a');
    var actitem = actmen.clone();
    actitem.css( 'height', '45px' );
    actitem.css( 'position', 'absolute' );
    actitem.prependTo(actmen.parent());
    
    $("#content input").focus(function(){
        $("#content label[for="+this.id+"]").css({color: '#000'});
    });

    $("#content input").blur(function(){
        $("#content label[for="+this.id+"]").css({textDecoration: 'none', color: '#888'});
    });
    
    $("#content select,#content input:checkbox,#content input:radio,#content input:file").uniform();

    $('#content input:submit').each(function(){

        var submt = $(this);
        var val = $(this).val();
        // submt.parent().append('<a class="awesome" onclick="submit(); return false;">'+val+'</a>');
        submt.parent().append('<button class="awesome" type="submit">'+val+'</button>');
        submt.hide();
    })
    
    // edit
    $('#content tbody tr').click(function(){
        var href = $(this).find("a[href*=edit]").attr('href');
        if(href){
            self.location.href = href;
        }
    });
    
    // flash messages
    // $('#flash .notice').delay(2000).fadeOut('fast');
    $('#flash .notice').delay(1500).slideUp('fast');
    
});
