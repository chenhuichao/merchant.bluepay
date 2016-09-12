{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/entity-index.js"></script>
<!-- 标题栏 -->
	<div class="main-title">
		<h2>新增实体页面</h2>
	</div>

<div class="content-box">
	<div class="content-box-content">
		<div class="tab-content default-tab">
			<form action="/bought/addsubmit/" name="myform" id="myform"
				onsubmit="return checkParam()" method="post">
				<fieldset>
				<div class="form-item">
		            <label class="item-label">Entity名</label>
					<div class="controls">
						<input class="text input-large" type="text" name="entity"
							id="e_entity" onblur="checkentity(this.value)">
					</div>
		        </div>
				<div class="form-item">
		            <label class="item-label">初始值</label>
					<div class="controls">
						<input class="text input-large" type="number" id="id_genter_start" value=1>				     
					</div>
		        </div>
		        <br>
					<table class="table">
						<tbody id="f_table">
						<tr>
							<th>字段名</th>
							<th>类型</th>
							<th>属性</th>
							<th>默认值</th>
							<th>操作</th>
						</tr>
						<tr>
							<td>id</td>
							<td>id_genter</td>
							<td></td>
							<td></td>
							<td><a href="javascript:void(0)" onclick="moveUp(this)">上</a>&nbsp;&nbsp;&nbsp;<a
								href="javascript:void(0)" onclick="moveDown(this)">下</a></td>
						</tr>
						<tr>
							<td>ctime</td>
							<td>ctime</td>
							<td></td>
							<td>now</td>
							<td><a href="javascript:void(0)" onclick="moveUp(this)">上</a>&nbsp;&nbsp;&nbsp;<a
								href="javascript:void(0)" onclick="moveDown(this)">下</a></td>
						</tr>
						<tr>
							<td>utime</td>
							<td>utime</td>
							<td></td>
							<td>now</td>
							<td><a href="javascript:void(0)" onclick="moveUp(this)">上</a>&nbsp;&nbsp;&nbsp;<a
								href="javascript:void(0)" onclick="moveDown(this)">下</a></td>
						</tr>
						</tbody>
					</table>
					</p>
					<p>
					<table class="table">
						<tr>
							<td style="width: 100px;">字段名：</td>
							<td><input type="text" class="text input-large"
								id="f_name"></td>
						</tr>
						<tr>
							<td>字段类型：</td>
							<td><select id="f_type" class=" input-large">
									<optgroup label="日期和时间">
										<option value="date">DATE 日期</option>
										<option value="time">TIME 时间</option>
										<option value="datetime">DATETIME 日期时间</option>
									</optgroup>
									<optgroup label="数字">
										<option value="int unsigned">INT(unsigned) 整型(不可为负数)</option>
										<option value="tinyint unsigned">TINYINT(unsigned)
											短整型(不可为负数)</option>
										<option value="decimal">DECIMAL 小数(需要输入类似 5,2 )</option>
										<option value="int">INT 整型(可为负数)</option>
										<option value="float">FLOAT 浮点型</option>
									</optgroup>
									<optgroup label="字符串">
										<option value="char">CHAR 字符串</option>
										<option value="varchar">VARCHAR 字符串</option>
										<option value="text">TEXT 大段文本（65535个字）</option>
										<option value="mediumtext">MEDIUMTEXT
											超大段文本（16777215个字）</option>
									</optgroup>
							</select></td>

						</tr>
						<tr>
							<td>字段属性：</td>
							<td><input type="text" id="f_attr"
								class="text input-large">(int等数字类型不需要填写，varchar为长度，decimal为
								整数位,小数位)</td>
						</tr>
						<tr>
							<td>默认值：</td>
							<td><input type="text"
							id="f_default" class="text input-large">数字建议为0，表示状态建议为1，字符串、文本类型留空</td>
						</tr>
					</table>
					</p>
					<p>
						<span> <input class="btn" type="button"
							onclick="addRow()" value="添加这个字段"> 
							<input class="btn"
							type="button" value="生成数据" onclick="return submitAll()">
						</span>
					</p>
				</fieldset>
				<div class="clear"></div>
				<!-- End .clear -->
			</form>
		</div>
		<!-- End #tab2 -->
	</div>
	<!-- End .content-box-content -->

</div>
{include file="footer.tpl"}
