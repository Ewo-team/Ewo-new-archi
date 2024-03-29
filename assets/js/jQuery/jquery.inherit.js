/**
 * Inheritance plugin
 *
 * Copyright (c) 2010 Filatov Dmitry (alpha@zforms.ru)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * @version 1.3.2.M
 */

(function($) {

var hasIntrospection = (function(){_}).toString().indexOf('_') > -1,
	needCheckProps = $.browser.msie, // fucking ie hasn't toString, valueOf in for
	specProps = needCheckProps? ['toString', 'valueOf'] : null,
	emptyBase = function() {};

function override(base, result, add) {

	var hasSpecProps = false;
	if(needCheckProps) {
		var addList = [];
		$.each(specProps, function() {
			add.hasOwnProperty(this) && (hasSpecProps = true) && addList.push({
				name : this,
				val  : add[this]
			});
		});
		if(hasSpecProps) {
			$.each(add, function(name) {
				addList.push({
					name : name,
					val  : this
				});
			});
			add = addList;
		}
	}

	$.each(add, function(name, prop) {
		if(hasSpecProps) {
			name = prop.name;
			prop = prop.val;
		}
		if($.isFunction(base[name]) && $.isFunction(prop) &&
		   (!hasIntrospection || prop.toString().indexOf('.__base') > -1)) {

			var baseMethod = base[name];
			result[name] = function() {
				var baseSaved = this.__base;
				this.__base = baseMethod;
				var result = prop.apply(this, arguments);
				this.__base = baseSaved;
				return result;
			};

		}
		else {
			result[name] = prop;
		}

	});

}

$.inherit = function() {

	var withMixins = $.isArray(arguments[0]),
		hasBase = withMixins || $.isFunction(arguments[0]),
		base = hasBase? withMixins? arguments[0][0] : arguments[0] : emptyBase,
		props = arguments[hasBase? 1 : 0] || {},
		staticProps = arguments[hasBase? 2 : 1],
		result = props.__constructor || (hasBase && base.prototype.__constructor)?
			function() {
				this.__constructor.apply(this, arguments);
			} : function() {};

	if(!hasBase) {
		result.prototype = props;
		result.prototype.__self = result.prototype.constructor = result;
		return $.extend(result, staticProps);
	}

	$.extend(result, base);

	var inheritance = function() {},
		basePtp = base.prototype;
	inheritance.prototype = base.prototype;
	result.prototype = new inheritance();
	var resultPtp = result.prototype;
	resultPtp.__self = resultPtp.constructor = result;

	override(basePtp, resultPtp, props);
	staticProps && override(base, result, staticProps);

	if(withMixins) {
		var i = 1, mixins = arguments[0], mixin, __constructors = [];
		while(mixin = mixins[i++]) {
			$.each(mixin.prototype, function(propName) {
				if(propName == '__constructor') {
					__constructors.push(this);
				}
				else if(propName != '__self') {
					resultPtp[propName] = this;
				}
			});
		}
		if(__constructors.length > 0) {
			resultPtp.__constructor && __constructors.push(resultPtp.__constructor);
			resultPtp.__constructor = function() {
				var i = 0, __constructor;
				while(__constructor = __constructors[i++]) {
					__constructor.apply(this, arguments);
				}
			};
		}
	}

	return result;

};

})(jQuery);