function checkentity(entity){
	entity = $.trim(entity);
	if(entity=='')
	{
		$('#e_entity').val('');
		return;
	}

	$.ajax({
		url:'/entity/ajaxQueryEntity/?entity='+encodeURIComponent(entity),
		async:true,
		dataType:'json',
		success:function(data){
			if(data.code=='succ')
			{
				$('#checkentity_result').html('可用');
			}else
			{
				$('#checkentity_result').html('已重复，不可用');

			}
		}
	});
}

function deleteRow(obj)
{
	var oTR = obj.parentNode.parentNode;
	oTR.parentNode.removeChild(oTR);
}

function addRow()
{
	var f_name = $('#f_name').val();
	var f_type = $('#f_type').val();
	var f_attr = $('#f_attr').val();
	var f_default = $('#f_default').val();
	if(! /^[a-z][a-z0-9\_]*$/.test(f_name))
	{
		alert('字段名需要以字母开头，字母、数字、下划线的组合');
		return;
	}
	switch(f_type)
	{
		case 'date':
			if(f_attr!='')
			{
				alert('日期类型不需要属性，清空继续');
				$('#f_attr').val('');
				return;
			}
			if(! /^\d{4}-\d{2}-\d{2}$/.test(f_default))
			{
				alert('默认值非日期格式，需要填写格式为0000-00-00');
				return;
			}
			break;
		case 'time':
			if(f_attr!='')
			{
				alert('时间类型不需要属性，清空继续');
				$('#f_attr').val('');
				return;
			}
			if(! /^\d{2}:\d{2}:\d{2}$/.test(f_default))
			{
				alert('默认值非时间格式，需要填写格式为00:00:00');
				return;
			}
			break;
		case 'datetime':
			if(f_attr!='')
			{
				alert('时间类型不需要属性，清空继续');
				$('#f_attr').val('');
				return;
			}
			if(! /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/.test(f_default))
			{
				alert('默认值非时间格式，需要填写格式为0000-00-00 00:00:00');
				return;
			}
			break;
		case 'varchar':
			if(f_attr=='')
			{
				alert('VARCHAR类型需要填写长度作为属性');
				$('#f_attr').val('');
				return;
			}
			if(! /^\d+$/.test(f_attr))
			{
				alert('VARCHAR类型的属性为长度，应填写纯数字值');
				return;
			}
			break;

	}

	var oTR = document.createElement('TR');

	var oTD = document.createElement('TD');
	oTD.innerHTML = f_name;
	oTR.appendChild(oTD);

	var oTD = document.createElement('TD');
	oTD.innerHTML = f_type;
	oTR.appendChild(oTD);

	var oTD = document.createElement('TD');
	oTD.innerHTML = f_attr;
	oTR.appendChild(oTD);

	var oTD = document.createElement('TD');
	oTD.innerHTML = f_default;
	oTR.appendChild(oTD);

	var oTD = document.createElement('TD');
	oTD.innerHTML = '<a href="#" onclick="deleteRow(this)">删除</a>';
	oTR.appendChild(oTD);


	$('#f_table')[0].appendChild(oTR);

	$('#f_name').val('');
	//$('#f_type').val('');
	$('#f_attr').val('');
	$('#f_default').val('');



}

function moveUp(obj)
{
	var current=$(obj).parent().parent();  
    var prev=current.prev();  
    if(current.index()>1)  
    {  
        current.insertBefore(prev);  
    }  
}

function moveDown(obj)  
{  
    var current=$(obj).parent().parent();  
    var next=current.next();  
    if(next)  
    {  
        current.insertAfter(next);  
    }  
}


function submitAll()
{
	var f_table = document.getElementById('f_table');
	var entity = $('#e_entity').val();
	if(entity == ''){
		$('#e_entity').focus();
		return;
	}

	var post_data = 'entity='+entity+'&id_genter_start='+$('#id_genter_start').val();

	for(var i=1;i<f_table.rows.length;i++)
	{
		var row = f_table.rows[i];


		post_data+= '&f_name[]='+row.cells[0].innerHTML;
		post_data+= '&f_type[]='+row.cells[1].innerHTML;
		post_data+= '&f_attr[]='+row.cells[2].innerHTML;
		post_data+= '&f_default[]='+row.cells[3].innerHTML;
	}

	$.ajax(
		{
			type: "POST",
			url: "/entity/indexSubmit/?",
			data: post_data,
			success: function(msg){
				alert(msg);
			}
		}
	);
}




