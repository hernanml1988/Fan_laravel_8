/* Flot plugin that adds some extra symbols for plotting points.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The symbols are accessed as strings through the standard symbol options:

    series: {
        points: {
            symbol: "square" // or "diamond", "triangle", "cross", "plus", "ellipse", "rectangle"
        }
    }

*/


    // we normalize the area of each symbol so it is approximately the
    // same as a circle of the given radius

(function(b){function a(h,e,g){var d={square:function(k,j,n,i,m){var l=i*Math.sqrt(Math.PI)/2;k.rect(j-l,n-l,l+l,l+l)},diamond:function(k,j,n,i,m){var l=i*Math.sqrt(Math.PI/2);k.moveTo(j-l,n);k.lineTo(j,n-l);k.lineTo(j+l,n);k.lineTo(j,n+l);k.lineTo(j-l,n)},triangle:function(l,k,o,j,n){var m=j*Math.sqrt(2*Math.PI/Math.sin(Math.PI/3));var i=m*Math.sin(Math.PI/3);l.moveTo(k-m/2,o+i/2);l.lineTo(k+m/2,o+i/2);if(!n){l.lineTo(k,o-i/2);l.lineTo(k-m/2,o+i/2)}},cross:function(k,j,n,i,m){var l=i*Math.sqrt(Math.PI)/2;k.moveTo(j-l,n-l);k.lineTo(j+l,n+l);k.moveTo(j-l,n+l);k.lineTo(j+l,n-l)}};var f=e.points.symbol;if(d[f]){e.points.symbol=d[f]}}function c(d){d.hooks.processDatapoints.push(a)}b.plot.plugins.push({init:c,name:"symbols",version:"1.0"})})(jQuery);
