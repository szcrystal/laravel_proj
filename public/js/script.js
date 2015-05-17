(function($){

    $(function(){
    
    //$('h1').text('aaa');
    
    
    
    dragdrop();

	function dragdrop() {
            
            //jQueryではdataTransferプロパティがeventに入っていない
            $.event.props.push( "dataTransfer" );
            
            // global
            var dr = $('#dropArea');
            var imgArr = new Array();
            
            //境界内に入った時
            dr.on('dragenter', function(e){
            	$(this).addClass('dover');
                //$('#page-main').append('<p>bbb</p>');
                $('#progBar').css({width:0});
            });
            
            //drop領域上にある時
            dr.on('dragover', function(e) {
            	e.preventDefault();
            	
                //$('p').text(pt);
                
            	for(var i=0; i < e.dataTransfer.types.length; i++) {
                	if(e.dataTransfer.types[i] == 'text/plain') {
                    	e.preventDefault();
                        break;
                    }
                }
                
                //$('#page-main').append('<p>ccc</p>');
            });
            
            //境界から離れた時
            dr.on('dragleave', function(e){
            	$(this).removeClass('dover');
                
                
            });
            
            //Dropされた時 Fileドロップと要素ドロップ兼用
            dr.on('drop', function(e){
            	e.preventDefault();
                
                var $th = $(this);
                
                $(e.target).removeClass('dover');
                
                if(e.dataTransfer.files.length) { //Fileドロップ時                    
                    
                    var fileLength = e.dataTransfer.files.length;
                    $('h1').text(fileLength);
                    
                    //datas.append("files[]", e.dataTransfer.files[0]);
					
                    var datas = new FormData();
                    
                    var fls = e.dataTransfer.files;
                    
                    //var imgArr = new Array();
                    
                    //for (var k in fls) { 
                    //for eachだと効かない forEach()メソッドも効かない　なぜか?? -> 元々javascript独自拡張で for each構文は廃止らしい
                    //現在は for of 構文らしい　for (let i of arr) {} from MDN Document
                    $.each(fls, function(index, value){	//jQueryでは、$.each()で配列とObjectのループをさせることが可能。 $('').each()はDOM Eelement用
                        //var file = fls[k];
                        var file = value;
                        console.log(file);
                    	
                        datas.append('text', 'abcde');
                        datas.append("files[]", file); //<input type="file" name="files[]" /> の要素を追加することと同じ
                    	
                        var reader = new FileReader(); //fileReaderコンストラクター
                        reader.readAsDataURL(file);
                        
                        
                        reader.onload = function(e){ //FileReader()に対してjQuery-onメソッドが効かない。 -> 必要ならbindで
                        	
                            //console.log(reader.result);
                            
                            var dataURL = e.target.result; //reader.resultとして直接指定とすると効かない 下記のwhile構文でおかしくなるのもこれが原因か
                            //イベントハンドラ内（関数）は非同期に進むので上位スコープ外の変数（ここではvar readerなど、繰り返し構文内で毎回代入するもの）を利用する時は注意。何かとおかしくなる（変数内容がずれる）
                            
                            if(dataURL.indexOf('base64') > -1) {
                                dr.append('<img src="' + dataURL + '" class="addimg" style="float:left; width:120px; height:auto;" />');
                                
                                imgArr.push('images/' + file.name);
                                //この配列をpostする動作は下記ajaxのsuccess内に記述
                                
                            } //dataUrl.indexOf
                            else {
                            	dr.text(reader.result);
                            }
                        }; //onLoad
                        
                        reader.onerror = function(e) {
                        	if(reader.error.code === reader.error.ENCODING_ERR) {
                            	dr.text('Error' + reader.error);
                            	return;
                            }
                        };
                    	
                    
                    }); //$.each
                    //}
                    
                    /*
                	while(i < fileLength) {
	                	
                        //★★File オブジェクト
                        var file = e.dataTransfer.files[i];
    	                
                        //$(this).append('<p>' + file.name + '</p>');
                        
                        //★★FileReader オブジェクト
                    	var reader = new FileReader();
                        
                        //FileReader プログレスバー reader.readAsDataURL(file);より前にある必要あり
//                        reader.onprogress = function(e) {
//                        	if(e.lengthComputable) {
//                            	var loaded = e.loaded / e.total;
//                                $('#progBar').animate({width: 100 * loaded + '%'}, 300, 'linear'); //$('#page').width()*loaded + 'px'
//                            }
//                        };
						
                        
                        // ★★ POINT Formインスタンスへの追加メソッド
						// POST data reader.onloadの外にある必要あり
                        //FormData()のオブジェクトに追加することでinputと同じ処理が出来る 第一引数はname属性に該当、第二引数は値
                        datas.append('text', 'abcde');
                        datas.append("files[]", file);
                        
                        
                        //★★FileReaderのファイル読み込みメソッド -----
                        //reader.readAsArrayBuffer(file);
                        //reader.readAsBinaryString(file);
                        //reader.readAsText(file);
                        reader.readAsDataURL(file);
                        
                        console.log('LOGLOGLOG_1>> '+ i);
                        

                    
                    
                        reader.onload = function(e){ //FileReader()に対してonメソッドが効かない。ないみたい
                        	//console.log(reader.result);
                            
                            var dataURL = reader.result;
                            
                            if(dataURL.indexOf('base64') > -1) {
                                dr.append('<img src="' + dataURL + '" class="addimg" style="position:relative; top:0; left:' + i*150 + 'px; width:120px; height:auto;" />');
                                
                                console.log('LOGLOGLOG_2>> '+ i);
                                return;
                                
                                //console.log('dataURL >>> ' + dataURL);
                                
                                //WebStorage のlocalStorage(Global Object)に保存 
                                //localStorage.bg = dataURL;
                                
                                //データベースに入れる処理をここに書けるか
                                //------------------------------------
                                   
                                   
                            	//---------------------------------
                                
                            } //dataUrl.indexOf
                            else {
                            	dr.text(reader.result);
                            }
                        }; //onLoad
                        
                        reader.onerror = function(e) {
                        	if(reader.error.code === reader.error.ENCODING_ERR) {
                            	dr.text('Error' + reader.error);
                            	return;
                            }
                        };
                        
                        i++;
                    } //while   
					*/
//                    aaa = new Array();
//                    aaa.push('ddd');
//                    var imgLink = imgArr.join(';');
//                    console.log('LOGLOG>> ' + imgLink);
//                    
//                    dr.append('<input type="hidden" name="imgLink" value="' + imgLink + '" />');
                    
 
                    /* Ajax */
                    $.ajax({
                        type: "POST",
                        url: '/upload.php', //laravelではweb rootからのフルパスが安全
                        data: datas,
                        processData: false,
                        contentType: false,
                        success: function(datas) { //success
                            console.log('upload is done' + datas);
                            
                            //ファイルのリンク先をDBにpostするための処理 dataform.blade.phpに<input>をappendする
                            var imgLink = imgArr.join(';'); //implode
                    		dr.append('<input type="hidden" name="imgLink" value="' + imgLink + '" />');
                            
                        },//success
                        
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            $("div").html('送信出来ませんでした。'+ errorThrown);
                        } //ajax error
                        
                    }); //ajax
                    
                    
                    //console.log(file); //fileオブジェクトのプロパティが確認出来る
                    
                }
                else { //要素ドロップ
                	var name = e.dataTransfer.getData('text/plain');
                    var html = e.dataTransfer.getData('text/html');
                    
                    //$(this).text(html);
                    
//                    if($(this).children('li').is(':visible')) {
//                        $('li',this).after(html);
//                        //$(this).html(html);
//                    }
//                    else {
                        $(this).append(html);
                    //}
                                
                    console.log(html);
                }
                
                //$('#page-main').append('<p>aaa</p>');
                
            }); //dr.onDrop
            
            /*drag dropでのデスクトップへのダウンロード：仕様がなくなったか？　効かない
            $('.dragout').on('dragstart', function(e){
            	console.log(this.dataset.downloadurl);
            	e.preventDefault();
            	e.dataTransfer.setData('DownLoadURL', this.dataset.downloadurl);
                
                
            });
            */
            
            
            
            
        } //func dd
    	
        
    }); //doc.ready



})(jQuery);
