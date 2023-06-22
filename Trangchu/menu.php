                <div class="nav-product" id="nav-product">
                    <?php require('hienthiSP.php'); ?>
                </div>
                <div id="CTSP" style="display: none;">
                    <?php require('hienthiCTSP.php'); ?>
                </div>
<script>
                var loai =null;
                var theloai = document.querySelectorAll('.nav-menu__text');
                for (var i = 0; i < theloai.length; i++) {
                    var id = theloai[i].parentNode.getAttribute('id');
                    document.getElementById(id).addEventListener("click", function(event) {
                            loai = event.target.getAttribute('data-value');
                        event.preventDefault();
                        var url = 'Trangchu/hienthiSP.php?loai='+loai;
                        console.log(url);
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                $('#nav-product').html(response);
                            },
                            error: function() {
                            }
                                                
                        });
                    });
                }
                $('.header__search').submit(function(event) {
                    event.preventDefault();
                    var url = $(this).attr('action') + '?' + $(this).serialize()+'&loai='+loai;
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            $('#nav-product').html(response);
                        },
                        error: function() {
                        }
                    });
                });

                function showsp(page) {
                    var search=document.getElementById("search").value;
                    var money1=document.getElementById("money1").value;
                    var money2=document.getElementById("money2").value;
                    var sosp=document.getElementById("sosp").value;
                    event.preventDefault();
                      var url = 'Trangchu/hienthiSP.php?sotrang='+ page+'&loai='+loai+'&search='+search+'&money1='+money1+'&money2='+money2+'&sosp='+sosp;
                      console.log(url);
                      $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            
                          $('#nav-product').html(response);
                        },
                        error: function() {
                        }
                      });
                  }

                function hienCTSP(maSP) {
                            console.log("da vao");
                            event.preventDefault();
                            var url = 'Trangchu/hienthiCTSP.php?maSP=' + maSP ;
                            console.log(url);
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response) {
                                    document.getElementById("CTSP").style.display='block';
                                    $('#CTSP').html(response);
                                },
                                error: function() {
                                }
                            });
                }
                function mua(maSP) {
                            console.log("da vao");
                            var quantity=document.getElementById('quantity').value;
                            event.preventDefault();
                            var url = 'Trangchu/giohang.php?masp=' + maSP +'&quantity='+quantity;
                            console.log(url);
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response) {
                                alert(response);
                                },
                                error: function() {
                                }
                            });
                }
                

                // $('button.mua').on( "click", function(event) {
                //     if(parseInt(document.getElementById('quantity').value) <= 0){
                //         alert('Số lượng sản phẩm không được âm'); 
                //         document.getElementById('quantity').value = 1;
                //         document.getElementById('quantity').focus();
                //     }
                //     else {
                //         var str = document.getElementById('maSP').value
                //         var sl = document.getElementById('quantity').value;
                //         // giohang(str,sl);
                //     }
                //     console.log("đã vào đây");
                //         event.preventDefault();
                //     })
                // $.ajax({
                //     type: 'Get',
                //     url: "Trangchu/giohang.php",
                //     data: 'masp='+str+'&sl='+sl,
                //     console.log(url);
                //     success: function(result){ 
                //         newstr = result.split(" ").join("");
                //         newstr =parseInt(newstr)
                //         if(parseInt(newstr) == 1)
                //             alert('thêm vào giỏ hàng thành công');
                //         else
                //             alert('xin lỗi, chúng tôi chỉ còn'+newstr+"sản phẩm");
                //     }   
                // });
</script>