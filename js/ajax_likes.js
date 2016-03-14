/*js
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajax Likes v1.02
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : AL201-102
//
// This software is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2 of the
// License.
//
// [Product Home Page]
// http://www.phpkobo.com/ajax_likes.php
//
// [Installation Guide]
// http://www.phpkobo.com/doc.php?d=install&p=AL201-102
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
*/

(function($){

var MSG_CAN_VOTE = "Thank you for voting!";
var MSG_CANT_VOTE = "You have already voted!";

//-----------------------------------------------
// showTip
//-----------------------------------------------
var period_tip_window = 3000;
function showTip( obj, txt, bgcolor )
{
	txt = typeof txt !== 'undefined' ? txt : "Saved！";
	var tip_box = obj.find( 'span[ttype="tip_box"]' ).clone();
	if ( !tip_box.length )
	{
		var s = '';
		s += "<span ";
		s += "style='";
		s += "text-align:center;";
		s += "padding:10px;";
		s += "margin:10px;";
		s += "font-size:15px;";
		s += "font-weight:bold;";
		s += "font-style:italic;";
		s += "font-family:times;";
		s += "color:#ffffff;";
		s += "background-color:" + bgcolor + ";";
		s += "border:3px solid #cfcfcf;";
		s += "border-radius: 15px;";
		s += "-moz-border-radius: 15px;";
		s += "-moz-box-shadow: 1px 1px 3px #000;";
		s += "-webkit-box-shadow: 1px 1px 3px #000;";
		s += "'>";
		s += txt;
		s += "</span>";
		tip_box = $( s );
	}

	tip_box.css({
		"position":"absolute",
		"left":"-10000px",
		"top":"-10000px"
	});

	tip_box.appendTo( $( 'body' ) );
	tip_box.show();

	wt = tip_box.outerWidth(false);
	ht = tip_box.outerHeight(true);

	var x = obj.offset().left;
	var y = obj.offset().top;
	var w = obj.width();
	var h = obj.height();

	var ytd = 10;
	var xt = x + w/2 - wt/2;
	var yt = y - ht;

	tip_box.css( { "left":xt + "px", "top":yt + "px" } );
	tip_box.fadeOut( period_tip_window, function() {
	    tip_box.remove();
	});
}


//----------------------------------------------------------------
// CCookie
//----------------------------------------------------------------
function CCookie()
{
}

CCookie.prototype =
{
	set : function( name, value, days )
	{
		days = days || 365;
		var date = new Date();
		date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
		var expires = "; expires="+date.toGMTString();

		document.cookie = name + "=" + value + expires + "; path=/";
	},

	get : function( name )
	{
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i < ca.length; i++ )
		{
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	},

	del : function( name )
	{
		document.cookie = name + '=; expires=Fri, 3 Aug 2001 20:47:11 UTC; path=/';
	}
}

var Cookie = new CCookie();

//----------------------------------------------------------------
// CAjaxLikes
//----------------------------------------------------------------
function CAjaxLikes( domobj )
{
	this.domobj = domobj;
	this.tid = this.getAttr( 'tid', domobj );
	this.url_server = this.getAttr( 'action', domobj );
}

CAjaxLikes.prototype =
{
	//-----------------------------------------------
	// getAttr
	//-----------------------------------------------
	getAttr : function( id_name, obj )
	{
		if (
			( typeof( $( obj ).attr( id_name ) ) == 'undefined' ) || 
			( $( obj ).attr( id_name ) == '' ) // for Opera
		) return null;
		return $( obj ).attr( id_name );
	},

	//-----------------------------------------------
	// getCookieName
	//-----------------------------------------------
	getCookieName : function()
	{
		return 'ajax_likes_' + this.tid;
	},

	//-----------------------------------------------
	// checkCookie
	//-----------------------------------------------
	checkCookie : function()
	{
		var key = this.getCookieName();
		var s = Cookie.get( key );
		if ( s == null )
		{
			Cookie.set( key, 'yes' );
			return true;
		}
		else
			return false;
	},

	//-----------------------------------------------
	// send
	//-----------------------------------------------
	send : function( v )
	{
		var _this = this;
		$.post( this.url_server,
			{ cmd: "vote", tid:this.tid, vote:v },
   			function(data) {
				var res = eval('(' + data + ')');
				if ( res.result == 'OK' )
				{
					_this.items = res.items;
					_this.displayStats();
				}
				else
				{
					alert( res.result );
				}
		});
	},

	//-----------------------------------------------
	// run
	//-----------------------------------------------
	run : function()
	{
		var s = '';
		s += "<div class='ld-bar-like'></div>";
		s += "<div class='ld-bar-dislike'></div>";
		s += "<div class='ld-clear-both'></div>";
		$( this.domobj ).find( '.ld-stats-bar' ).html( s );

		var _this = this;

		$( this.domobj ).find( '.ld-btn-like' ).click( function(e){
			e.preventDefault();
			_this.vote( $(this), 'likes' );
		});

		$( this.domobj ).find( '.ld-btn-dislike' ).click( function(e){
			e.preventDefault();
			_this.vote( $(this), 'dislikes' );
		});

		$( this.domobj ).find( '.ld-btn-reset' ).click( function(e){
			e.preventDefault();
			var key = _this.getCookieName();
			Cookie.del( key );
			alert( 'Cookie has been reset!' );
		});

		this.send( '' );
	},

	//-----------------------------------------------
	// vote
	//-----------------------------------------------
	vote : function( obj, v )
	{
		if ( this.checkCookie() )
		{
			showTip( obj, MSG_CAN_VOTE, "#60a060" );
		}
		else
		{
			showTip( obj, MSG_CANT_VOTE, "red" );
			return;
		}

		this.items[v]++;
		this.displayStats();
		this.send( v );
	},

	//-----------------------------------------------
	// displayStats
	//-----------------------------------------------
	displayStats : function()
	{
		var n_likes = this.items['likes'];
		var n_dislikes = this.items['dislikes'];

		var stats_bar = $( this.domobj ).find( '.ld-stats-bar' );
		var w_stats_bar = stats_bar.width();

		var n_total = n_likes + n_dislikes;

		var w_like;
		var w_dislike;
		if ( n_total == 0 )
		{
			w_like = 0;
			w_dislike = 0;
		}
		else if ( n_dislikes == 0 )
		{
			w_like = w_stats_bar;
			w_dislike = 0;
		}
		else if ( n_likes == 0 )
		{
			w_like = 0;
			w_dislike = w_stats_bar;
		}
		else
		{
			w_like = Math.abs( w_stats_bar * n_likes / n_total );
			w_dislike = (w_stats_bar-1) - w_like;
		}
		stats_bar.find( '.ld-bar-like' ).width( w_like );
		stats_bar.find( '.ld-bar-dislike' ).width( w_dislike );

		var stats_txt = '';
		stats_txt += n_likes + ' like';
		if ( n_likes != 1 ) stats_txt += 's';
		stats_txt += ', ';
		stats_txt += n_dislikes + ' dislike';
		if ( n_dislikes != 1 ) stats_txt += 's';
		$( this.domobj ).find( '.ld-stats-txt' ).html( stats_txt );
	}
}

//----------------------------------------------------------------
// ready
//----------------------------------------------------------------
$(document).ready(function() {
	$( '.ld-container' ).each( function(){
		var obj = new CAjaxLikes( this ); 
		obj.run();
	});
});

}(jQuery));
