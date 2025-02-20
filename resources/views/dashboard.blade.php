@extends('layouts.app')

@section('title', '控制台')

@section('content')
    <div class="row g-4">
        <!-- 歡迎卡片 -->
        <div class="col-12 col-md-8">
            <div class="card welcome-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Welcome Back, Chris!</h5>
                        <p class="mb-0">AppStack Dashboard</p>
                    </div>
                    <img src="https://via.placeholder.com/150" alt="Welcome" style="height: 120px;">
                </div>
            </div>
        </div>

        <!-- 收益卡片 -->
        <div class="col-12 col-md-4">
            <div class="card earnings-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>$ 24,300</h3>
                        <span class="text-success">$</span>
                    </div>
                    <div>Total Earnings</div>
                    <div class="mt-2">
                        <span class="badge bg-success">+5.35%</span>
                        <span class="text-muted ms-2">Since last week</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 表格區域 -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Basic Table</h5>
                    <p class="text-muted">Using the most basic table markup, here's how table-based tables look in
                        Bootstrap.</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First</th>
                                    <th>Last</th>
                                    <th>Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry the Bird</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
