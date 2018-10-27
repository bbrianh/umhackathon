<!DOCTYPE html>
<html style="height: 100%">
   <head>
       <meta charset="utf-8">
   </head>
   <body style="height: 100%; margin: 0">
	<div id="title"><h1>UM 2018-10-26 Dinner consumption</h1><a style='float:right' href="../api_pc/index.html">To main page</a></div>
       <div id="container" style="height: 100%"></div>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
	   <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>
       <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	   
       <script type="text/javascript">
var dom = document.getElementById("container");
var myChart = echarts.init(dom);
var app = {};
option = null;
var posList = [
    'left', 'right', 'top', 'bottom',
    'inside',
    'insideTop', 'insideLeft', 'insideRight', 'insideBottom',
    'insideTopLeft', 'insideTopRight', 'insideBottomLeft', 'insideBottomRight'
];

app.configParameters = {
    rotate: {
        min: -90,
        max: 90
    },
    align: {
        options: {
            left: 'left',
            center: 'center',
            right: 'right'
        }
    },
    verticalAlign: {
        options: {
            top: 'top',
            middle: 'middle',
            bottom: 'bottom'
        }
    },
    position: {
        options: echarts.util.reduce(posList, function (map, pos) {
            map[pos] = pos;
            return map;
        }, {})
    },
    distance: {
        min: 0,
        max: 100
    }
};

app.config = {
    rotate: 90,
    align: 'left',
    verticalAlign: 'middle',
    position: 'insideBottom',
    distance: 15,
    onChange: function () {
        var labelOption = {
            normal: {
                rotate: app.config.rotate,
                align: app.config.align,
                verticalAlign: app.config.verticalAlign,
                position: app.config.position,
                distance: app.config.distance
            }
        };
        myChart.setOption({
            series: [{
                label: labelOption
            }, {
                label: labelOption
            }, {
                label: labelOption
            }, {
                label: labelOption
            }]
        });
    }
};


var labelOption = {
    normal: {
        show: true,
        position: app.config.position,
        distance: app.config.distance,
        align: app.config.align,
        verticalAlign: app.config.verticalAlign,
        rotate: app.config.rotate,
        formatter: '{c}  {name|{a}}',
        fontSize: 16,
        rich: {
            name: {
                textBorderColor: '#fff'
            }
        }
    }
};





	
	option = {
		color: ['#003366', '#006699', '#4cabce', '#e5323e'],
	
		legend: {
			data: ['7:00~8:00', '8:00~9:00', '9:00~10:00', '10:00~11:00']
		},
		
		calculable: true,
		xAxis: [
			{
				type: 'category',
				axisTick: {show: false},
				data: ['CKLC', 'CKPC', 'CKYC', 'CYTC', 'FPJC', 'LCWC', 'MCMC', 'MLC', 'SEAC', 'SPC']
			}
		],
		yAxis: [
			{
				type: 'value'
			}
		],
		series: [
			{
				name: '7:00~8:00',
				type: 'bar',
				barGap: 0,
				label: labelOption,
				data: []
			},
			{
				name: '8:00~9:00',
				type: 'bar',
				label: labelOption,
				data: []
			},
			{
				name: '9:00~10:00',
				type: 'bar',
				label: labelOption,
				data: []
			},
			{
				name: '10:00~11:00',
				type: 'bar',
				label: labelOption,
				data: []
			}
		]
	};;
	
	var hr=[17,18,19,20];
	var date="2018-10-26"
	
	for (i=0;i<hr.length;i++){
		$.ajax({
			method:"GET",
			url:"getDataForGraph(d).php",
			data:{date:date,hr:hr[i]}
		}).done(function(response){
		console.log(option["series"][response.id]);
		option["series"][response.id]["data"]=response.data;
		myChart.setOption(option, true);
			
		})
	}
	
       </script>
   </body>
</html>