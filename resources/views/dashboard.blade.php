@extends('layouts/app')
@section('content')

<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h3>Welcome {{$user->name}}</h3>
							</div>
                     <div class="col-sm-6">
				           <button style=""><a href="{{route('settings.edit')}}">Budget Setting</a></button>
				           <button style=""><a href="{{route('transactions.index')}}">Transactions</a></button>
                       <button style=""><a href="{{route('logout')}}">logout</a></button>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>{{$totalExpenses}}</h3>
										<p>Total Expense</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>{{$totalIncome}}</h3>
										<p>Total Income</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>{{$balance}}</h3>
										<p>Total Balance</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
                           <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>

                  <div class="row">
                  <div class="col-md-12 col-lg-6">
                     <div class="card card-chart">
                        <div class="card-header">
                           <div class="row align-items-center">
                              <div class="col-6">
                                 <h5 class="card-title">ALL DATA</h5>
                              </div>

                           </div>
                        </div>
                        <div class="card-body">
                           <div id="ALL_DETAILS"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                     <div class="card card-chart">
                        <div class="card-header">
                           <div class="row align-items-center">
                              <div class="col-6">
                                 <h5 class="card-title">Income & Expenses</h5>
                              </div>

                           </div>
                        </div>
                        <div class="card-body">
                           <div id="incomeexpenses"></div>
                        </div>
                     </div>
                  </div>
                  
               </div>

                 
                  
               </div>

              


               <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card flex-fill fb sm-box">
                        <a class="fab fa-facebook" href=""></a>
                        <h6>50,095</h6>
                        <p>Likes</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card flex-fill twitter sm-box">
                        <a class="fab fa-twitter" href=""></a>
                        <h6>48,596</h6>
                        <p>Follows</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card flex-fill insta sm-box">
                         <a class="fab fa-instagram"  href=""></a>
                        <h6>52,085</h6>
                        <p>Follows</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card flex-fill linkedin sm-box">
                        <a class="fab fa-linkedin-in" href=""></a>
                        <h6>69,050</h6>
                        <p>Follows</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                     <div class="card flex-fill YouTube sm-box">
                         <a class="fab fa-youtube" style="color:  #d9bc52;" href=""></a>
                        <h6>52,085</h6>
                        <p>Follows</p>
                     </div>
                  </div>
               </div>
					</div>					
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>

            @include('layouts.chart')
@endsection