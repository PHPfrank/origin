
    var pageinit=function(options,_this){
        var defaults = {
            pageDom: 'pagination',    //分页显示元素ID
            showPage: true,           //显示分页
            maxPage: 6,  //最大分页数
            page:{pageSize:1,currentPage:1},
            _count:10,
            condition:{}

        };
        var originalOptions = options || {};

        var extent = $.extend(true, {}, defaults, options);
        extent.original = originalOptions;
        $.extend(this, extent);
        this.getPage(_this);
        return this;
    };
        getPage=function(_this){
            if(this._count<this.page.pageSize){
                $('#' + this.pageDom).html('');
                return;
            }
            var html = '<ul class="pagination">';
            html += '<li><a href="javascript:" class="prev_page">&laquo;</a></li>';
            if(this._count >= 0) {
                this.page.page_total = Math.ceil(this._count / this.page.pageSize);
                if(this.page.page_total <= this.maxPage) {
                    for(var i = 1; i <= this.page.page_total; i ++) {
                        if(i == this.page.currentPage) {
                            html += '<li class="active"><a href="javascript:">'+i+'</a></li>';
                        } else {
                            html += '<li><a href="javascript:" class="page" rel="'+i+'">'+i+'</a></li>';
                        }
                    }
                } else {
                    var page_html = '';
                    var half = this.maxPage / 2;
                    var _c = 0; //已输出页码总数
                    var _cl = 0; //左边起始页
                    var _cr = 0; //右边结束
                    /** 计算出左边起始页*/
                    if(this.page.currentPage < half) {
                        _cl = 1;
                    } else {
                        if(this.page.currentPage > (this.page.page_total - half)) {
                            _cl = this.page.page_total - this.maxPage + 1;
                        } else {
                            _cl = this.page.currentPage - half + 1;
                        }
                    }
                    /** 计算出右边起始页*/
                    _cr = _cl + this.maxPage - 1;
                    for(var i = _cl; i <= _cr; i++) {
                        if(this.page.currentPage == i) {
                            page_html = page_html + '<li class="active"><a href="javascript:">'+i+'</a></li>';
                        } else {
                            page_html = page_html + '<li><a href="javascript:" class="page" rel="'+i+'">'+i+'</a></li>';
                        }
                    }
                    /** 加上第一页*/
                    if(_cl > 1) {
                        page_html = '<li><a href="javascript:" class="page" rel="'+1+'">1...</a></li>' + page_html;
                    }
                    /** 加上最后一页*/
                    if(_cr < this.page.page_total) {
                        page_html = page_html + '<li><a href="javascript:" class="page" rel="'+this.page.page_total+'">...'+this.page.page_total+'</a></li>';
                    }
                    html += page_html;
                }
            } else {
                return false;
            }

            html += '<li><a href="javascript:" class="next_page">&raquo;</a></li><li><a href="javascript:">共 '+this.page.page_total+' 页 , '+this._count+' 条记录</a></li>';

            if(this.page.page_total <= 1){
                html = '<ul class="pagination"><li><a href="javascript:">共 '+this.page.page_total+' 页 , '+this._count+' 条记录</a></li></ul>';
            }
            console.log(this.pageDom);
            $('#' + this.pageDom).html(html);
            //绑定事件
            $('.page').on('click', function() {
                go(parseInt($(this).attr('rel')));
            });
            $('.prev_page').on('click', function() {
                prev();
            });
            $('.next_page').on('click', function() {
                next();
            });

            /** 跳转到某页 */
            go=function(page) {
                _this.page=page;
                //_this.offset = ((page - 1) * this.page.pageSize);
                this.page.currentPage = page;
                fetch();
            },

            /** 上一页 */
            prev=function() {
                if(this.page.currentPage > 1) {
                    this.page.currentPage --;
                    _this.page --;
                    //_this.offset = ((this.page.currentPage - 1) * this.page.pageSize);
                    fetch();
                }
            },

            /** 下一页 */
            next=function() {
                if(this.page.currentPage < this.page.page_total) {
                    this.page.currentPage ++;
                    _this.page ++;
                    //_this.offset = ((this.page.currentPage - 1) * this.page.pageSize);
                    fetch();
                }
            }
        }




