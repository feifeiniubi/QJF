
// myForm 插件
(function( $ ){
    $.fn.myForm = function(success) {
        return this.each(function() {
            $(this).on('submit', function (e) {
                e.preventDefault();
                var form = $(this);

                $.post(form.attr('action'), form.serialize(), success);
            })
        });
    };

    $.fn.myFormData = function (data) {
        return this.each(function () {
            $(':input[name]', this).each(function () {
                // console.log(this); = '
                var ipt = $(this);
                var oldval = ipt.val();
                var type = ipt.attr('type');

                var name = ipt.attr('name');
                var newval;
                var mcRst = name.match(/(.+)\[(.+)\]$/);
                if (mcRst) {
                    newval = data[ mcRst[1] ][ mcRst[2] ];
                }else{
                    name = name.replace(/\[\]$/,'');
                    newval = data[name];
                }

                if (oldval) {
                    if (type==='checkbox') {
                        if (newval.indexOf(oldval)>=0) {
                            ipt.prop('checked', true);
                        }
                        return;
                    } else if (type==='radio') {
                        if (oldval==newval) {
                            ipt.prop('checked', true);
                        }
                        // console.warn('myFormData: radio类型input，暂时无法自动填充', this);
                        return;
                    } else if(this.tagName==='SELECT') {
                        // console.log(this);
                        var slcd = $('[selected]', this).length;
                        if (slcd) {
                            console.info('myFormData: 遇到已经有值的select，自动跳过。', this);
                            return;
                        }
                    } else {
                        console.info('myFormData: 遇到已经有值的input，自动跳过。', this);
                        return;
                    }
                }
                if (type==='password') {
                    console.info('myFormData: 遇到password类型input，自动跳过。', this);
                    return;
                }
                ipt.val(newval);
            });
        });
    };
    
    $.fn.tmdUpload = function(options){
        var settings = {
            url : '',
            field : 'file',
            accept : 'image/*',
            sizeMax : 1024*5,
            sizeError : '文件大小超过5M无法上传',
            type : 'json',
            callback : function(){},
            before : function(){}
        };
        $.extend(settings, options);

        return this.on('click', function(){
            var btnEle = this;

            var $fileInput = $('<input type="file">').attr({
                accept : settings.accept
            }).on('change',function(){
                var file = $fileInput[0].files[0];
                if ( file.size > 1024 * settings.sizeMax ) {
                    layer.alert(settings.sizeError);
                    return;
                }
                var fd = new FormData();
                fd.append(settings.field, file);
                $.ajax({
                    type: "POST",
                    url : settings.url,
                    data : fd,
                    beforeSend : settings.before,
                    success : settings.callback,
                    dataType : settings.type,
                    processData: false,
                    contentType: false,
                    context: btnEle
                });
            }).trigger('click');
        });
    }

})( jQuery );

function pageInit() {
    $('select[data-val][data-val!=""]').val(function () {
        return $(this).data('val');
    });

    $('select.mySelect').removeClass('mySelect').select2({
        placeholder: "请选择...",
        allowClear: true,
        minimumResultsForSearch: 10
    });

    $(".tmdDate").removeClass('tmdDate').datetimepicker({
        language:  "zh-CN",
        weekStart: 1,
        autoclose: 1,
        todayBtn:  1,
        todayHighlight: 1,
        minView: 2,
        format: "yyyy-mm-dd"
    });

    $(".tmdDatetime").removeClass('tmdDatetime').datetimepicker({
        language:  "zh-CN",
        weekStart: 1,
        autoclose: 1,
        todayBtn:  1,
        todayHighlight: 1,
        minView: 0,
        format: "yyyy-mm-dd hh:ii"
    });
    $(".tmdTime").removeClass('tmdTime').datetimepicker({
        language:  "zh-CN",
        autoclose: 1,
        startView: 1,
        maxView: 1,
        format: 'hh:ii'
    });
    // 仅选择年
    $(".tmdYear").datetimepicker(
        {
            language:  "zh-CN",
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 4,
            minView: 4,
            forceParse: 0,
            format: "yyyy"
        });
    // 删除记录
    $('a.tmdDelete').removeClass('tmdDelete').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var text = $(this).text() || '删除';

        layer.open({
            title: '确认',
            content: '确定要执行'+text+'操作吗？',
            icon: 3,
            shadeClose: true,
            btn: ['确定', '取消'],
            yes: function (idx) {
                layer.close(idx);
                $.get(url, function (ret) {
                    if (ret.msg) {
                        layer.alert(ret.msg, {
                            icon: 0,
                            yes: function () {
                                if (ret.url) {
                                    location.href = ret.url;
                                }else{
                                    location.reload();
                                }
                            }
                        });
                    }

                });
            }
        });
    });

    $('a.jsModal').removeClass('jsModal').on('click', function (e) {
        e.preventDefault();
        var self = $(this);

        var setw = parseInt(self.data('width'));
        if (setw) { // 如何设置了宽度
            var maxw = document.body.clientWidth - 30;

            if (setw>maxw) {
                var maxh = document.body.clientHeight - 30;
                setw = [maxw+'px', maxh+'px'];
            }else{
                setw += 'px';
            }
        }else{ // 如果没设置宽度，那就自动
            setw = 'auto';
        }

        $.get(self.attr('href'), function (html) {
            //console.log(html);
            window.lastLayerIndex = layer.open({
                type: 1,
                title: self.attr('title') || '',
                content: html,
                area: setw
            });
        }, 'html');

    });

    // 图片上传组件
    $('.tmdUpload-upload').removeClass('tmdUpload-upload').tmdUpload({
        url: '/360/public_html/index.php/admin/upload/input',
        callback: function (json) {
            $(this).parent().prev().val(json.path)
        }
    });
    // 图片上传组件MEMBER
    $('.tmdUpload-upload-member').removeClass('tmdUpload-upload-member').tmdUpload({
        url: '/360/public_html/index.php/member/upload/input',
        callback: function (json) {
            $(this).parent().prev().val(json.path)
        }
    });
    // 查看
    $('.tmdUpload-show').removeClass('tmdUpload-show').on('click', function (e) {
        var imgUrl = $(this).parent().prev().val();
        imgUrl = my.imgUrl(imgUrl);

        layer.photos({
            photos: {
                "data": [
                    {
                        "src": imgUrl
                    }
                ]
            }
        });
    });
    // 删除
    $('.tmdUpload-delete').removeClass('tmdUpload-delete').on('click',function (e) {
        e.preventDefault();
        $(this).parent().prev().val('');
    });

    // 地图标注
    $('.tmdMap-mark').removeClass('tmdMap-mark').on('click', function (e) {
        e.preventDefault();

        var inputs = $(this).closest('.input-group').find('input');
        window.mapMarkInputJ = inputs[0];
        window.mapMarkInputW = inputs[1];

        $.get('/360/public_html/index.php/admin/index/mapMark', function (html) {
            window.lastLayerIndex = layer.open({
                type: 1,
                title: '地图标注',
                content: html,
                area: ['850px', '550px']
            });
        }, 'html');
    });
}

var my = {
    imgUrl: function (img) {
        return '/uploads/'+img;
    },
    menuActive: function (url) {
        url = '/admin/'+url;
        $('li:has(a[href="' + url + '"])').addClass('active');
    },
    mobFoot: function (id) {
        $('.myMobFoot [data-id="' + id +'"]').addClass('active');
    },
    ImageFileResize: function (file, maxWidth, maxHeight, callback) {
        var Img = new Image;
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');

        Img.onload = function() {
            if (Img.width>maxWidth || Img.height>maxHeight) {
                var bili = Math.max(Img.width/maxWidth, Img.height/maxHeight);
                canvas.width = Img.width/bili;
                canvas.height = Img.height/bili;
            }else{
                canvas.width = Img.width;
                canvas.height = Img.height;
            }
            ctx.drawImage(Img, 0, 0, Img.width, Img.height, 0, 0, canvas.width, canvas.height);

//            $('body').append(canvas);
            callback(canvas.toDataURL('image/jpeg', 0.8));
        };

        try{
            Img.src = window.URL.createObjectURL(file);
        }catch(err){
            try{
                Img.src = window.webkitURL.createObjectURL(file);
            }catch(err){
                layer.alert(err.message);
            }
        }
    }
};

$(function () {
    // 全局 ajax 设置
    $.ajaxSetup({
        dataType: 'json',
        timeout: 30000,
        statusCode: {
            404: function () {
                layer.open({
                    title: '出错啦~',
                    content: '数据已被删除！',
                    icon: 2
                });
            }
        },
        error: function (jqXHR) {
            if (jqXHR.statusText=='abort') {
                return;
            }
            if (!jqXHR.responseJSON) {
                console.log(jqXHR);
                layer.alert('操作繁忙,请重试!');
                return;
            }

            var ret = jqXHR.responseJSON;

            if (ret.msg==='valid') {
                var errs = [];
                for (var key in ret.data) {
                    errs.push(ret.data[key]);
                }

                layer.open({
                    title: '验证失败',
                    content: '<ol><li>'+errs.join('</li><li>')+'</li></ol>',
                    icon: 0,
                    shadeClose: true,
                    end: function () {
                        if (ret.url) {
                            window.location.href = ret.url;
                        }
                    }
                });
                // console.error(errs);
            } else if (ret.msg) {
                layer.open({
                    title: '错误',
                    content: ret.msg,
                    icon: 2,
                    shadeClose: true,
                    end: function () {
                        if (ret.url) {
                            window.location.href = ret.url;
                        }
                    }
                });
            }else if (ret.url) {
                window.location.href = ret.url;
            }
        },
        success: function (ret) {
            if (ret.msg) {
                layer.open({
                    title: '操作成功',
                    content: ret.msg,
                    icon: 1,
                    shadeClose: true,
                    time: 1000,
                    end: function () {
                        if (ret.url) {
                            window.location.href = ret.url;
                        }
                    }
                });
            } else if (ret.url) {
                window.location.href = ret.url;
            }
        }
    });
    // 开始 ajax 时显示 loading
    var ajaxLoadIdx;
    $(document).ajaxStart(function () {
        ajaxLoadIdx = layer.load();
    });
    $(document).ajaxStop(function () {
        layer.close(ajaxLoadIdx);
    });

    $('.navbar-toggle').on('click', function () {
        var obj = $('.myNav');
        if (obj.hasClass('hidden-xs')) {
            obj.removeClass('hidden-xs');
        }else{
            obj.addClass('hidden-xs');
        }
    });

    pageInit();

    // 链接带hash的时候 自动选中标签页
    if (location.hash) {
        $('a[data-tab][href="' + location.hash + '"]').closest('li').addClass('active')
            .siblings().removeClass('active');

        $(location.hash+'.tab-pane').addClass('active')
            .siblings().removeClass('active');
    }
    // 自动展开父菜单
    $('.nav-parent:has(.active)').addClass('show');

    if (window.wangEditor) {
        wangEditor.config.mapAk = 'IgnZ4taUjaliYvT1wIFX7mi2';
        // wangEditor.config.printLog = false;
        wangEditor.config.uploadImgUrl = '/admin/upload/wangEditor';
        wangEditor.config.uploadImgFileName = 'file';
    }
});