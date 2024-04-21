(function($){
    "use strict";
    var HT={};
    HT.setupCkeditor=()=>{
        if($('.ck-editor')){
            $('.ck-editor').each(function(){
                let editor=$(this)
                let elementId=editor.attr('id')
                let elementHeight=editor.attr('data-height')
                HT.ckeditor4(elementId, elementHeight);
            });
        }

    }
    HT.ckeditor4=(elementId, elementHeight)=>{
        if(typeof(elementHeight)=='undefined'){
            elementHeight=500;
        }
        CKEDITOR.replace(elementId, {
            height:elementHeight,
            removeButtons:'',
            entities: true,
            allowedContent: true,
            toolbarGroups: [
                {name:'clipboard',groups:['clipboard','undo']},
                {name:'editing',groups:['find','selection','spellchecker']},
                {name:'links'},
                {name:'insert'},
                {name:'forms'},
                {name:'tools'},
                {name:'document',groups:['mode','document','doctools']},
                {name:'colors'},
                {name:'others'},
                '/',
                {name:'basicstyles',groups:['basicstyles','cleanup']},
                {name:'paragraph',groups:['list','indent','blocks','align']},
                {name:'styles'},
            ],
        });
      
            
    }
    HT.uploadImageToInput=()=>{
    $('.upload-image').click(function(){
        let input= $(this)
        let type= input.attr('data-type')
        HT.setupCKFinder2(input, 'Images');
    })
    }
    HT.uploadImageAvatar=()=>{
        $('.image-target').click(function(){
            let input= $(this)
            let type= 'Images';
            HT.browserServerAvatar(input, type);    
        })
    }
    HT.setupCKFinder2=(object,type)=>{
        if(typeof(type)=='undefined'){
            type='Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function(fileUrl,data){
            object.val(fileUrl)

        }
        finder.popup();
    }
    HT.browserServerAvatar=(object,type)=>{
        if(typeof(type)=='undefined'){
            type='Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function(fileUrl,data){
            object.find('img').attr('src',fileUrl)
            object.siblings('input').val(fileUrl)

        }
        finder.popup();
    }
    $(document).ready(function(){
        HT.uploadImageToInput();
        HT.setupCkeditor();
        HT.uploadImageAvatar();

    });
 /*  HT.inputImage=()=>{
        $(document).on('click','.input-image',function(){
            let _this=$(this);
            let fileUpload = _this.attr('data-upload');
            HT.BrowseServerInput($(this), fileUpload);
        });
    }
    HT.BrowseServerInput=(object, type)=>{
        if(typeof(type)=='undefined'){
            type='Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function(fileUrl,data){
           // fileUrl = fileUrl.replace(BASE_URL, "/");
            object.val(fileUrl);
        }
        finder.popup();
    }
    


    $(document).ready(function(){
       HT.inputImage();
    });
*/
})(jQuery) 


