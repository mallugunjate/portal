$.fn.extend({
    treed: function (o) {
      
      var openedClass = '';
      var closedClass = '';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {                    
                    
                    //close all other folders
                    $(".indicator").removeClass('fa-folder-open').addClass('fa-folder');
                    
                    //get top-level parent folder
                    var topLevelParent = $(this).closest('.top-level');
                    
                    if( $(this).attr('id') != topLevelParent.attr('id')) {
                        
                        topLevelParent.children("i:first").removeClass('fa-folder').addClass('fa-folder-open');

                        allParents = $(this).parentsUntil(".top-level");

                        allParents.each(function(item){
                            
                            if ($(this).is('li')) {
                               $(this).children("i:first").removeClass('fa-folder').addClass('fa-folder-open');
                            }

                        });
                    }
                    else{

                    }
                   
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        tree.find('.branch .folder-name').each(function(){
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
                e.stopPropagation();
            });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});


