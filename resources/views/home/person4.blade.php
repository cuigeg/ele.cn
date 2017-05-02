@extends('/home/person')
@section('tou','个人资料')
@section('cc')
<div class="page-content">
						<div class="page-header">
							<h1>个人资料</h1>
						</div>
						<!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="clearfix">
									<div class="pull-left alert alert-success no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>

										<i class="icon-umbrella bigger-120 blue"></i>
										
									</div>

									<div class="pull-right">
										<span class="green middle bolder">Choose profile: &nbsp;</span>

										<div class="btn-toolbar inline middle no-margin">
											<div data-toggle="buttons" class="btn-group no-margin">
												<label class="btn btn-sm btn-yellow active">
													<span class="bigger-110">1</span>

													<input value="1" type="radio">
												</label>

												<label class="btn btn-sm btn-yellow">
													<span class="bigger-110">2</span>

													<input value="2" type="radio">
												</label>

												<label class="btn btn-sm btn-yellow">
													<span class="bigger-110">3</span>

													<input value="3" type="radio">
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="hr dotted"></div>
								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<a href='/personal/person1'><img id="avatar"  class="editable img-responsive editable-click editable-empty" alt="请把您的魅力完全绽放在这里" src="{{$res->pic}}"></a>
												</span>

												<div class="space-4"></div>

												<div class="width-80 label  label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<i class="icon-circle light-green middle"></i>
															&nbsp;
															<span class="white">杰克王</span>
														</a>

														<ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
															<li class="dropdown-header"> 状态 </li>

															<li>
																<a href="#">
																	<i class="icon-circle green"></i>
																	&nbsp;
																	<span class="green">Available</span>
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="icon-circle red"></i>
																	&nbsp;
																	<span class="red">Busy</span>
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="icon-circle grey"></i>
																	&nbsp;
																	<span class="grey">Invisible</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="profile-contact-info">
												<div class="profile-contact-links align-left">
													<a class="btn btn-link" href="#">
														<i class="icon-plus-sign bigger-120 green"></i>
														加为好友
													</a>

													<a class="btn btn-link" href="#">
														<i class="icon-envelope bigger-120 pink"></i>
														最近活动
													</a>

													<a class="btn btn-link" href="#">
														<i class="icon-globe bigger-125 blue"></i>
														www.苍老师.com
													</a>
												</div>

												<div class="space-6"></div>

												<div class="profile-social-links center">
													<a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
														<i class="middle icon-facebook-sign icon-2x blue"></i>
													</a>

													<a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
														<i class="middle icon-twitter-sign icon-2x light-blue"></i>
													</a>

													<a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
														<i class="middle icon-pinterest-sign icon-2x red"></i>
													</a>
												</div>
											</div>

											

											<div class="clearfix">
												
													<span class="bigger-175 blue">25</span>
													关注
												</div>

												<div class="grid2">
													<span class="bigger-175 blue">12</span>
													收藏
												</div>

											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">
											<div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> 1411 </span>

													<br>
													<span class="line-height-1 smaller-90">订餐币</span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> 32 </span>

													<br>
													<span class="line-height-1 smaller-90">平均接餐速度</span>
												</span>

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> 55 </span>

													<br>
													<span class="line-height-1 smaller-90"> 订餐次数 </span>
												</span>
											</div>

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> 姓名 </div>
												@if(isset($res->nikename))		
												<div class="profile-info-value">
														<span class="editable editable-click" id="username">{{$res->nikename}}</span>
													</div>
												</div>
												@else
												<div class="profile-info-value">
														<span class="editable editable-click" id="username">&nbsp;</span>
													</div>
												</div>
												@endif
												@if(isset($res->position))
												<div class="profile-info-row">
													<div class="profile-info-name"> 地址 </div>
													<div class="profile-info-value">
														<i class="icon-map-marker light-orange bigger-110"></i>
														<span class="editable editable-click" id="country">{{$res->position}}</span>
													</div>
												</div>
												@else
												<div class="profile-info-row">
													<div class="profile-info-name"> 地址 </div>
													<div class="profile-info-value">
														<span class="editable editable-click" id="country">&nbsp;</span>
													</div>
												</div>
												@endif
												<div class="profile-info-row">
													<div class="profile-info-name"> 年龄 </div>
													<div class="profile-info-value">
														<span class="editable editable-click" id="age">38</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> 生日 </div>

													<div class="profile-info-value">
														<span class="editable editable-click" id="signup">20/06/2010</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> 最后登录时间 </div>

													<div class="profile-info-value">
														<span class="editable editable-click" id="login">3 hours ago</span>
													</div>
												</div>
												@if(isset($res->phone))
												<div class="profile-info-row">
													<div class="profile-info-name"> 电话 </div>
													<div class="profile-info-value">
														<span class="editable editable-click" id="about">{{$res->phone}}</span>
													</div>
												</div>
												@else
												<div class="profile-info-row">
													<div class="profile-info-name"> 电话 </div>
													<div class="profile-info-value">
														<span class="editable editable-click" id="about">&nbsp;</span>
													</div>
												</div>
												@endif

											</div>

											<div class="space-20"></div>

											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="blue smaller">
														<i class="icon-rss orange"></i>
														最近活动
													</h4>

													<div class="widget-toolbar action-buttons">
														<a href="#" data-action="reload">
															<i class="icon-refresh blue"></i>
														</a>

														&nbsp;
														<a href="#" class="pink">
															<i class="icon-trash"></i>
														</a>
													</div>
												</div>
											</div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											<div class="center">
												<a href="#" class="btn btn-sm btn-primary">
													<i class="icon-rss bigger-150 middle"></i>
													<span class="bigger-110">查看更多活动</span>

													<i class="icon-on-right icon-arrow-right"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>
@endsection
@section('js')
<script type="text/javascript" src='/js/jquery-2.2.3.min.js'></script>
@endsection