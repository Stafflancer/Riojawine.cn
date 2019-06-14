!function(u){"use strict";function l(t,e){this.$select=u(t),this.$select.attr("data-placeholder")&&(e.nonSelectedText=this.$select.data("placeholder")),this.options=this.mergeOptions(u.extend({},e,this.$select.data())),this.originalOptions=this.$select.clone()[0].options,this.query="",this.searchTimeout=null,this.lastToggledInput=null,this.options.multiple="multiple"===this.$select.attr("multiple"),this.options.onChange=u.proxy(this.options.onChange,this),this.options.onDropdownShow=u.proxy(this.options.onDropdownShow,this),this.options.onDropdownHide=u.proxy(this.options.onDropdownHide,this),this.options.onDropdownShown=u.proxy(this.options.onDropdownShown,this),this.options.onDropdownHidden=u.proxy(this.options.onDropdownHidden,this),this.options.onInitialized=u.proxy(this.options.onInitialized,this),this.buildContainer(),this.buildButton(),this.buildDropdown(),this.buildSelectAll(),this.buildDropdownOptions(),this.buildFilter(),this.updateButtonText(),this.updateSelectAll(!0),this.options.disableIfEmpty&&u("option",this.$select).length<=0&&this.disable(),this.$select.hide().after(this.$container),this.options.onInitialized(this.$select,this.$container)}"undefined"!=typeof ko&&ko.bindingHandlers&&!ko.bindingHandlers.multiselect&&(ko.bindingHandlers.multiselect={after:["options","value","selectedOptions","enable","disable"],init:function(t,e,i,s,l){var o=u(t),n=ko.toJS(e());if(o.multiselect(n),i.has("options")){var a=i.get("options");ko.isObservable(a)&&ko.computed({read:function(){a(),setTimeout(function(){var t=o.data("multiselect");t&&t.updateOriginalOptions(),o.multiselect("rebuild")},1)},disposeWhenNodeIsRemoved:t})}if(i.has("value")){var p=i.get("value");ko.isObservable(p)&&ko.computed({read:function(){p(),setTimeout(function(){o.multiselect("refresh")},1)},disposeWhenNodeIsRemoved:t}).extend({rateLimit:100,notifyWhenChangesStop:!0})}if(i.has("selectedOptions")){var h=i.get("selectedOptions");ko.isObservable(h)&&ko.computed({read:function(){h(),setTimeout(function(){o.multiselect("refresh")},1)},disposeWhenNodeIsRemoved:t}).extend({rateLimit:100,notifyWhenChangesStop:!0})}var c=function(t){setTimeout(function(){t?o.multiselect("enable"):o.multiselect("disable")})};if(i.has("enable")){var r=i.get("enable");ko.isObservable(r)?ko.computed({read:function(){c(r())},disposeWhenNodeIsRemoved:t}).extend({rateLimit:100,notifyWhenChangesStop:!0}):c(r)}if(i.has("disable")){var d=i.get("disable");ko.isObservable(d)?ko.computed({read:function(){c(!d())},disposeWhenNodeIsRemoved:t}).extend({rateLimit:100,notifyWhenChangesStop:!0}):c(!d)}ko.utils.domNodeDisposal.addDisposeCallback(t,function(){o.multiselect("destroy")})},update:function(t,e,i,s,l){var o=u(t),n=ko.toJS(e());o.multiselect("setOptions",n),o.multiselect("rebuild")}}),l.prototype={defaults:{buttonText:function(t,e){if(0<this.disabledText.length&&(this.disableIfEmpty||e.prop("disabled"))&&0==t.length)return this.disabledText;if(0===t.length)return this.nonSelectedText;if(this.allSelectedText&&t.length===u("option",u(e)).length&&1!==u("option",u(e)).length&&this.multiple)return this.selectAllNumber?this.allSelectedText+" ("+t.length+")":this.allSelectedText;if(t.length>this.numberDisplayed)return t.length+" "+this.nSelectedText;var i="",s=this.delimiterText;return t.each(function(){var t=void 0!==u(this).attr("label")?u(this).attr("label"):u(this).text();i+=t+s}),i.substr(0,i.length-2)},buttonTitle:function(t,e){if(0===t.length)return this.nonSelectedText;var i="",s=this.delimiterText;return t.each(function(){var t=void 0!==u(this).attr("label")?u(this).attr("label"):u(this).text();i+=t+s}),i.substr(0,i.length-2)},optionLabel:function(t){return u(t).attr("label")||u(t).text()},optionClass:function(t){return u(t).attr("class")||""},onChange:function(t,e){},onDropdownShow:function(t){},onDropdownHide:function(t){},onDropdownShown:function(t){},onDropdownHidden:function(t){},onSelectAll:function(t){},onInitialized:function(t,e){},enableHTML:!1,buttonClass:"btn btn-default",inheritClass:!1,buttonWidth:"auto",buttonContainer:'<div class="btn-group" />',dropRight:!1,dropUp:!1,selectedClass:"active",maxHeight:!1,checkboxName:!1,includeSelectAllOption:!1,includeSelectAllIfMoreThan:0,selectAllText:" Select all",selectAllValue:"multiselect-all",selectAllName:!1,selectAllNumber:!0,selectAllJustVisible:!0,enableFiltering:!1,enableCaseInsensitiveFiltering:!1,enableFullValueFiltering:!1,enableClickableOptGroups:!1,enableCollapsibelOptGroups:!1,filterPlaceholder:"Search",filterBehavior:"text",includeFilterClearBtn:!0,preventInputChangeEvent:!1,nonSelectedText:"None selected",nSelectedText:"selected",allSelectedText:"All selected",numberDisplayed:3,disableIfEmpty:!1,disabledText:"",delimiterText:", ",templates:{button:'<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>',ul:'<ul class="multiselect-container dropdown-menu"></ul>',filter:'<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',filterClearBtn:'<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',li:'<li><a tabindex="0"><label></label></a></li>',divider:'<li class="multiselect-item divider"></li>',liGroup:'<li class="multiselect-item multiselect-group"><label></label></li>'}},constructor:l,buildContainer:function(){this.$container=u(this.options.buttonContainer),this.$container.on("show.bs.dropdown",this.options.onDropdownShow),this.$container.on("hide.bs.dropdown",this.options.onDropdownHide),this.$container.on("shown.bs.dropdown",this.options.onDropdownShown),this.$container.on("hidden.bs.dropdown",this.options.onDropdownHidden)},buildButton:function(){this.$button=u(this.options.templates.button).addClass(this.options.buttonClass),this.$select.attr("class")&&this.options.inheritClass&&this.$button.addClass(this.$select.attr("class")),this.$select.prop("disabled")?this.disable():this.enable(),this.options.buttonWidth&&"auto"!==this.options.buttonWidth&&(this.$button.css({width:this.options.buttonWidth,overflow:"hidden","text-overflow":"ellipsis"}),this.$container.css({width:this.options.buttonWidth}));var t=this.$select.attr("tabindex");t&&this.$button.attr("tabindex",t),this.$container.prepend(this.$button)},buildDropdown:function(){if(this.$ul=u(this.options.templates.ul),this.options.dropRight&&this.$ul.addClass("pull-right"),this.options.maxHeight&&this.$ul.css({"max-height":this.options.maxHeight+"px","overflow-y":"auto","overflow-x":"hidden"}),this.options.dropUp){var t=Math.min(this.options.maxHeight,26*u('option[data-role!="divider"]',this.$select).length+19*u('option[data-role="divider"]',this.$select).length+(this.options.includeSelectAllOption?26:0)+(this.options.enableFiltering||this.options.enableCaseInsensitiveFiltering?44:0)),e=t+34;this.$ul.css({"max-height":t+"px","overflow-y":"auto","overflow-x":"hidden","margin-top":"-"+e+"px"})}this.$container.append(this.$ul)},buildDropdownOptions:function(){this.$select.children().each(u.proxy(function(t,e){var i=u(e),s=i.prop("tagName").toLowerCase();i.prop("value")!==this.options.selectAllValue&&("optgroup"===s?this.createOptgroup(e):"option"===s&&("divider"===i.data("role")?this.createDivider():this.createOptionValue(e)))},this)),u("li input",this.$ul).on("change",u.proxy(function(t){var e=u(t.target),i=e.prop("checked")||!1,s=e.val()===this.options.selectAllValue;this.options.selectedClass&&(i?e.closest("li").addClass(this.options.selectedClass):e.closest("li").removeClass(this.options.selectedClass));var l=e.val(),o=this.getOptionByValue(l),n=u("option",this.$select).not(o),a=u("input",this.$container).not(e);if(s?i?this.selectAll(this.options.selectAllJustVisible):this.deselectAll(this.options.selectAllJustVisible):(i?(o.prop("selected",!0),this.options.multiple?o.prop("selected",!0):(this.options.selectedClass&&u(a).closest("li").removeClass(this.options.selectedClass),u(a).prop("checked",!1),n.prop("selected",!1),this.$button.click()),"active"===this.options.selectedClass&&n.closest("a").css("outline","")):o.prop("selected",!1),this.options.onChange(o,i)),this.$select.change(),this.updateButtonText(),this.updateSelectAll(),this.options.preventInputChangeEvent)return!1},this)),u("li a",this.$ul).on("mousedown",function(t){if(t.shiftKey)return!1}),u("li a",this.$ul).on("touchstart click",u.proxy(function(t){t.stopPropagation();var e=u(t.target);if(t.shiftKey&&this.options.multiple){e.is("label")&&(t.preventDefault(),(e=e.find("input")).prop("checked",!e.prop("checked")));var i=e.prop("checked")||!1;if(null!==this.lastToggledInput&&this.lastToggledInput!==e){var s=e.closest("li").index(),l=this.lastToggledInput.closest("li").index();if(l<s){var o=l;l=s,s=o}++l;var n=this.$ul.find("li").slice(s,l).find("input");n.prop("checked",i),this.options.selectedClass&&n.closest("li").toggleClass(this.options.selectedClass,i);for(var a=0,p=n.length;a<p;a++){var h=u(n[a]);this.getOptionByValue(h.val()).prop("selected",i)}}e.trigger("change")}e.is("input")&&!e.closest("li").is(".multiselect-item")&&(this.lastToggledInput=e),e.blur()},this)),this.$container.off("keydown.multiselect").on("keydown.multiselect",u.proxy(function(t){if(!u('input[type="text"]',this.$container).is(":focus"))if(9===t.keyCode&&this.$container.hasClass("open"))this.$button.click();else{var e=u(this.$container).find("li:not(.divider):not(.disabled) a").filter(":visible");if(!e.length)return;var i=e.index(e.filter(":focus"));38===t.keyCode&&0<i?i--:40===t.keyCode&&i<e.length-1?i++:~i||(i=0);var s=e.eq(i);if(s.focus(),32===t.keyCode||13===t.keyCode){var l=s.find("input");l.prop("checked",!l.prop("checked")),l.change()}t.stopPropagation(),t.preventDefault()}},this)),this.options.enableClickableOptGroups&&this.options.multiple&&u("li.multiselect-group",this.$ul).on("click",u.proxy(function(t){t.stopPropagation(),console.log("test");var e=u(t.target).parent().nextUntil("li.multiselect-group").filter(":visible:not(.disabled)"),i=!0,s=e.find("input"),l=[];s.each(function(){i=i&&u(this).prop("checked"),l.push(u(this).val())}),i?this.deselect(l,!1):this.select(l,!1),this.options.onChange(s,!i)},this)),this.options.enableCollapsibleOptGroups&&this.options.multiple&&(u("li.multiselect-group input",this.$ul).off(),u("li.multiselect-group",this.$ul).siblings().not("li.multiselect-group, li.multiselect-all",this.$ul).each(function(){u(this).toggleClass("hidden",!0)}),u("li.multiselect-group",this.$ul).on("click",u.proxy(function(t){t.stopPropagation()},this)),u("li.multiselect-group > a > b",this.$ul).on("click",u.proxy(function(t){t.stopPropagation();var e=u(t.target).closest("li").nextUntil("li.multiselect-group"),i=!0;e.each(function(){i=i&&u(this).hasClass("hidden")}),e.toggleClass("hidden",!i)},this)),u("li.multiselect-group > a > input",this.$ul).on("change",u.proxy(function(t){t.stopPropagation();var e=u(t.target).closest("li").nextUntil("li.multiselect-group",":not(.disabled)").find("input"),i=!0;e.each(function(){i=i&&u(this).prop("checked")}),e.prop("checked",!i).trigger("change")},this)),u("li.multiselect-group",this.$ul).each(function(){var t=u(this).nextUntil("li.multiselect-group",":not(.disabled)").find("input"),e=!0;t.each(function(){e=e&&u(this).prop("checked")}),u(this).find("input").prop("checked",e)}),u("li input",this.$ul).on("change",u.proxy(function(t){t.stopPropagation();var e=u(t.target).closest("li"),i=e.prevUntil("li.multiselect-group",":not(.disabled)"),s=e.nextUntil("li.multiselect-group",":not(.disabled)"),l=i.find("input"),o=s.find("input"),n=u(t.target).prop("checked");l.each(function(){n=n&&u(this).prop("checked")}),o.each(function(){n=n&&u(this).prop("checked")}),e.prevAll(".multiselect-group").find("input").prop("checked",n)},this)),u("li.multiselect-all",this.$ul).css("background","#f3f3f3").css("border-bottom","1px solid #eaeaea"),u("li.multiselect-group > a, li.multiselect-all > a > label.checkbox",this.$ul).css("padding","3px 20px 3px 35px"),u("li.multiselect-group > a > input",this.$ul).css("margin","4px 0px 5px -20px"))},createOptionValue:function(t){var e=u(t);e.is(":selected")&&e.prop("selected",!0);var i=this.options.optionLabel(t),s=this.options.optionClass(t),l=e.val(),o=this.options.multiple?"checkbox":"radio",n=u(this.options.templates.li),a=u("label",n);a.addClass(o),n.addClass(s),this.options.enableHTML?a.html(" "+i):a.text(" "+i);var p=u("<input/>").attr("type",o);this.options.checkboxName&&p.attr("name",this.options.checkboxName),a.prepend(p);var h=e.prop("selected")||!1;p.val(l),l===this.options.selectAllValue&&(n.addClass("multiselect-item multiselect-all"),p.parent().parent().addClass("multiselect-all")),a.attr("title",e.attr("title")),this.$ul.append(n),e.is(":disabled")&&p.attr("disabled","disabled").prop("disabled",!0).closest("a").attr("tabindex","-1").closest("li").addClass("disabled"),p.prop("checked",h),h&&this.options.selectedClass&&p.closest("li").addClass(this.options.selectedClass)},createDivider:function(t){var e=u(this.options.templates.divider);this.$ul.append(e)},createOptgroup:function(t){if(this.options.enableCollapsibleOptGroups&&this.options.multiple){var e=u(t).attr("label"),i=u(t).attr("value"),s=u('<li class="multiselect-item multiselect-group"><a href="javascript:void(0);"><input type="checkbox" value="'+i+'"/><b> '+e+'<b class="caret"></b></b></a></li>');this.options.enableClickableOptGroups&&s.addClass("multiselect-group-clickable"),this.$ul.append(s),u(t).is(":disabled")&&s.addClass("disabled"),u("option",t).each(u.proxy(function(t,e){this.createOptionValue(e)},this))}else{var l=u(t).prop("label"),o=u(this.options.templates.liGroup);this.options.enableHTML?u("label",o).html(l):u("label",o).text(l),this.options.enableClickableOptGroups&&o.addClass("multiselect-group-clickable"),this.$ul.append(o),u(t).is(":disabled")&&o.addClass("disabled"),u("option",t).each(u.proxy(function(t,e){this.createOptionValue(e)},this))}},buildSelectAll:function(){if("number"==typeof this.options.selectAllValue&&(this.options.selectAllValue=this.options.selectAllValue.toString()),!this.hasSelectAll()&&this.options.includeSelectAllOption&&this.options.multiple&&u("option",this.$select).length>this.options.includeSelectAllIfMoreThan){this.options.includeSelectAllDivider&&this.$ul.prepend(u(this.options.templates.divider));var t=u(this.options.templates.li);u("label",t).addClass("checkbox"),this.options.enableHTML?u("label",t).html(" "+this.options.selectAllText):u("label",t).text(" "+this.options.selectAllText),this.options.selectAllName?u("label",t).prepend('<input type="checkbox" name="'+this.options.selectAllName+'" />'):u("label",t).prepend('<input type="checkbox" />');var e=u("input",t);e.val(this.options.selectAllValue),t.addClass("multiselect-item multiselect-all"),e.parent().parent().addClass("multiselect-all"),this.$ul.prepend(t),e.prop("checked",!1)}},buildFilter:function(){if(this.options.enableFiltering||this.options.enableCaseInsensitiveFiltering){var t=Math.max(this.options.enableFiltering,this.options.enableCaseInsensitiveFiltering);if(this.$select.find("option").length>=t){if(this.$filter=u(this.options.templates.filter),u("input",this.$filter).attr("placeholder",this.options.filterPlaceholder),this.options.includeFilterClearBtn){var e=u(this.options.templates.filterClearBtn);e.on("click",u.proxy(function(t){clearTimeout(this.searchTimeout),this.$filter.find(".multiselect-search").val(""),u("li",this.$ul).show().removeClass("filter-hidden"),this.updateSelectAll()},this)),this.$filter.find(".input-group").append(e)}this.$ul.prepend(this.$filter),this.$filter.val(this.query).on("click",function(t){t.stopPropagation()}).on("input keydown",u.proxy(function(t){13===t.which&&t.preventDefault(),clearTimeout(this.searchTimeout),this.searchTimeout=this.asyncFunction(u.proxy(function(){var a,p;this.query!==t.target.value&&(this.query=t.target.value,u.each(u("li",this.$ul),u.proxy(function(t,e){var i=0<u("input",e).length?u("input",e).val():"",s=u("label",e).text(),l="";if("text"===this.options.filterBehavior?l=s:"value"===this.options.filterBehavior?l=i:"both"===this.options.filterBehavior&&(l=s+"\n"+i),i!==this.options.selectAllValue&&s){var o=!1;if(this.options.enableCaseInsensitiveFiltering&&(l=l.toLowerCase(),this.query=this.query.toLowerCase()),this.options.enableFullValueFiltering&&"both"!==this.options.filterBehavior){var n=l.trim().substring(0,this.query.length);-1<this.query.indexOf(n)&&(o=!0)}else-1<l.indexOf(this.query)&&(o=!0);u(e).toggle(o).toggleClass("filter-hidden",!o),u(e).hasClass("multiselect-group")?(a=e,p=o):(o&&u(a).show().removeClass("filter-hidden"),!o&&p&&u(e).show().removeClass("filter-hidden"))}},this)));this.updateSelectAll()},this),300,this)},this))}}},destroy:function(){this.$container.remove(),this.$select.show(),this.$select.data("multiselect",null)},refresh:function(){var n=u.map(u("li input",this.$ul),u);u("option",this.$select).each(u.proxy(function(t,e){for(var i,s=u(e),l=s.val(),o=n.length;0<o--;)if(l===(i=n[o]).val()){s.is(":selected")?(i.prop("checked",!0),this.options.selectedClass&&i.closest("li").addClass(this.options.selectedClass)):(i.prop("checked",!1),this.options.selectedClass&&i.closest("li").removeClass(this.options.selectedClass)),s.is(":disabled")?i.attr("disabled","disabled").prop("disabled",!0).closest("li").addClass("disabled"):i.prop("disabled",!1).closest("li").removeClass("disabled");break}},this)),this.updateButtonText(),this.updateSelectAll()},select:function(t,e){u.isArray(t)||(t=[t]);for(var i=0;i<t.length;i++){var s=t[i];if(null!=s){var l=this.getOptionByValue(s),o=this.getInputByValue(s);void 0!==l&&void 0!==o&&(this.options.multiple||this.deselectAll(!1),this.options.selectedClass&&o.closest("li").addClass(this.options.selectedClass),o.prop("checked",!0),l.prop("selected",!0),e&&this.options.onChange(l,!0))}}this.updateButtonText(),this.updateSelectAll()},clearSelection:function(){this.deselectAll(!1),this.updateButtonText(),this.updateSelectAll()},deselect:function(t,e){u.isArray(t)||(t=[t]);for(var i=0;i<t.length;i++){var s=t[i];if(null!=s){var l=this.getOptionByValue(s),o=this.getInputByValue(s);void 0!==l&&void 0!==o&&(this.options.selectedClass&&o.closest("li").removeClass(this.options.selectedClass),o.prop("checked",!1),l.prop("selected",!1),e&&this.options.onChange(l,!1))}}this.updateButtonText(),this.updateSelectAll()},selectAll:function(t,e){t=void 0===(t=(!this.options.enableCollapsibleOptGroups||!this.options.multiple)&&t)||t;var i=u("li input[type='checkbox']:enabled",this.$ul),s=i.filter(":visible"),l=i.length,o=s.length;if(t?(s.prop("checked",!0),u("li:not(.divider):not(.disabled)",this.$ul).filter(":visible").addClass(this.options.selectedClass)):(i.prop("checked",!0),u("li:not(.divider):not(.disabled)",this.$ul).addClass(this.options.selectedClass)),l===o||!1===t)u("option:not([data-role='divider']):enabled",this.$select).prop("selected",!0);else{var n=s.map(function(){return u(this).val()}).get();u("option:enabled",this.$select).filter(function(t){return-1!==u.inArray(u(this).val(),n)}).prop("selected",!0)}e&&this.options.onSelectAll()},deselectAll:function(t){if(t=void 0===(t=(!this.options.enableCollapsibleOptGroups||!this.options.multiple)&&t)||t){var e=u("li input[type='checkbox']:not(:disabled)",this.$ul).filter(":visible");e.prop("checked",!1);var i=e.map(function(){return u(this).val()}).get();u("option:enabled",this.$select).filter(function(t){return-1!==u.inArray(u(this).val(),i)}).prop("selected",!1),this.options.selectedClass&&u("li:not(.divider):not(.disabled)",this.$ul).filter(":visible").removeClass(this.options.selectedClass)}else u("li input[type='checkbox']:enabled",this.$ul).prop("checked",!1),u("option:enabled",this.$select).prop("selected",!1),this.options.selectedClass&&u("li:not(.divider):not(.disabled)",this.$ul).removeClass(this.options.selectedClass)},rebuild:function(){this.$ul.html(""),this.options.multiple="multiple"===this.$select.attr("multiple"),this.buildSelectAll(),this.buildDropdownOptions(),this.buildFilter(),this.updateButtonText(),this.updateSelectAll(!0),this.options.disableIfEmpty&&u("option",this.$select).length<=0?this.disable():this.enable(),this.options.dropRight&&this.$ul.addClass("pull-right")},dataprovider:function(t){var s=0,l=this.$select.empty();u.each(t,function(t,e){var i;u.isArray(e.children)?(s++,i=u("<optgroup/>").attr({label:e.label||"Group "+s,disabled:!!e.disabled}),function(t,e){for(var i=0;i<t.length;++i)e(t[i],i)}(e.children,function(t){i.append(u("<option/>").attr({value:t.value,label:t.label||t.value,title:t.title,selected:!!t.selected,disabled:!!t.disabled}))})):(i=u("<option/>").attr({value:e.value,label:e.label||e.value,title:e.title,class:e.class,selected:!!e.selected,disabled:!!e.disabled})).text(e.label||e.value),l.append(i)}),this.rebuild()},enable:function(){this.$select.prop("disabled",!1),this.$button.prop("disabled",!1).removeClass("disabled")},disable:function(){this.$select.prop("disabled",!0),this.$button.prop("disabled",!0).addClass("disabled")},setOptions:function(t){this.options=this.mergeOptions(t)},mergeOptions:function(t){return u.extend(!0,{},this.defaults,this.options,t)},hasSelectAll:function(){return 0<u("li.multiselect-all",this.$ul).length},updateSelectAll:function(t){if(this.hasSelectAll()){var e=u("li:not(.multiselect-item):not(.filter-hidden) input:enabled",this.$ul),i=e.length,s=e.filter(":checked").length,l=u("li.multiselect-all",this.$ul),o=l.find("input");0<s&&s===i?(o.prop("checked",!0),l.addClass(this.options.selectedClass),this.options.onSelectAll(!0)):(o.prop("checked",!1),l.removeClass(this.options.selectedClass),0===s&&(t||this.options.onSelectAll(!1)))}},updateButtonText:function(){var t=this.getSelected();this.options.enableHTML?u(".multiselect .multiselect-selected-text",this.$container).html(this.options.buttonText(t,this.$select)):u(".multiselect .multiselect-selected-text",this.$container).text(this.options.buttonText(t,this.$select)),u(".multiselect",this.$container).attr("title",this.options.buttonTitle(t,this.$select))},getSelected:function(){return u("option",this.$select).filter(":selected")},getOptionByValue:function(t){for(var e=u("option",this.$select),i=t.toString(),s=0;s<e.length;s+=1){var l=e[s];if(l.value===i)return u(l)}},getInputByValue:function(t){for(var e=u("li input",this.$ul),i=t.toString(),s=0;s<e.length;s+=1){var l=e[s];if(l.value===i)return u(l)}},updateOriginalOptions:function(){this.originalOptions=this.$select.clone()[0].options},asyncFunction:function(t,e,i){var s=Array.prototype.slice.call(arguments,3);return setTimeout(function(){t.apply(i||window,s)},e)},setAllSelectedText:function(t){this.options.allSelectedText=t,this.updateButtonText()}},u.fn.multiselect=function(e,i,s){return this.each(function(){var t=u(this).data("multiselect");t||(t=new l(this,"object"==typeof e&&e),u(this).data("multiselect",t)),"string"==typeof e&&(t[e](i,s),"destroy"===e&&u(this).data("multiselect",!1))})},u.fn.multiselect.Constructor=l,u(function(){u("select[data-role=multiselect]").multiselect()})}(window.jQuery);