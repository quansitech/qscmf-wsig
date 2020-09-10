<?php
namespace Wsig;

use Illuminate\Support\Str;

class Wsig{

    protected $width;
    protected $height;
    protected $postUrl;

    public function __construct($width = '', $height = '')
    {
        $this->width = $width;
        $this->height = $height;

        $this->postUrl = U('/admin/extendQscmfWsig/save', '', false, true);
    }


    protected function getWidthCss(){
        if($this->width){
            return $this->width . 'px';
        }
        else{
            return '100%';
        }
    }

    protected function getHeightCss(){
        if($this->height){
            return $this->height . 'px';
        }
        else{
            return '70vh';
        }
    }

    public function setPostUrl($url){
        $this->postUrl = $url;
    }

    public function render($url, $options){
        $options = json_encode($options, JSON_PRETTY_PRINT);
        $uuid = Str::uuid()->getHex();
        $html = <<<html
<div style="text-align: center">
    <button style="background-color: #3c8dbc;border-color: #367fa9;font-weight: 500;color: #ffffff;padding: 6px 12px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    min-width: 120px;
    border-radius: 3px;
    border: 1px solid transparent;
    -webkit-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
    -moz-box-shadow: inset 0px -2px 0px 0px rgba(0, 0, 0, 0.09);
    box-shadow: inset 0px -1px 0px 0px rgba(0, 0, 0, 0.09);" id="save_{$uuid}">保存</button>
    <div>
        <iframe id="p_{$uuid}" style="width:{$this->getWidthCss()}; height:{$this->getHeightCss()}; border: 0px;" src="{$url}">
        </iframe>
        <script>
            var p_{$uuid} = document.getElementById('p_{$uuid}');
            
            document.getElementById('save_{$uuid}').addEventListener('click', function(e) {
                if(wg_{$uuid}){
                    fetch("{$this->postUrl}", {
                       method:'POST',
                       credentials: 'include',
                       headers:{
                           "Content-Type":'application/json',
                           'X-Requested-With':'xmlhttprequest'
                       },
                       body:JSON.stringify(wg_{$uuid}.getResult())
                    }).then(function(res){
                        return res.json();
                    }).then(function(res){
                        if(res.status == 1){
                            toastr["success"](res.info);
                        }
                        else{
                            toastr["error"](res.info);
                        }
                        
                        setTimeout(function(){
                            toastr.remove();
                            location.reload();
                        }, 2000);
                    });
                }
            });
            
            var wg_{$uuid} = null;
            p_{$uuid}.onload = function(){
                var doc = p_{$uuid}.contentDocument || p_{$uuid}.contentWindow.document;
                var win = p_{$uuid}.contentWindow;
                
                if(typeof win.QscmfWYSIWYG == 'undefined'){
                    var heads = doc.getElementsByTagName("head");
                    var script = doc.createElement("script");
                    
                    script.onload = function(){
                        wg_{$uuid} = new window.QscmfWYSIWYG({$options});
                    }
                    
                    
                    script.setAttribute("type", "text/javascript");
                    script.setAttribute("src", "/Public/qscmf-wsig/wysiwyg-bundle.js");
                    heads[0].appendChild(script);
                }
                else{
                    wg_{$uuid} = new win.QscmfWYSIWYG({$options}); 
                }
            }
        </script>
    </div>
</div>
html;
        return $html;
    }
}