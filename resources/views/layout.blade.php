<?php

use Illuminate\Support\Facades\Auth; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- this is for excel file package -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <!-- this is for chart.js package -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Inventory Management System</title>
    <style>
        .navbar-brand {
            color: rgb(255 255 255);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" style="padding:0">
        <div class="container-fluid" style="background: #545B77;">
            <a class="navbar-brand" href="#" style="text-decoration: none;color:white;padding:1%;">City Grab</a>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="nav ms-auto me-3">
                    <li class="nav-item">
                        <div class="dropdown">
                            <a style="text-decoration:none;color:#FBF4F3;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-fill h3"></i>
                                {{ Auth::user()->name }}
                                <span <?php if (Auth::user()->user_roll == '1') : ?> class="badge text-bg-info">Manager
                                <?php else : ?>
                                     class="badge text-bg-warning"> Staff
                                <?php endif ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="min-width:0;">
                                <li><a class="dropdown-item" href="/user/create" style="border-bottom: 1px solid #DDE6ED;">Create User Account</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="row" style="--bs-gutter-x: none;">
        <div class="col-md-2">
            <ul class="nav flex-column">
                @if (Auth::user()->user_roll == 1)
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard" style="text-decoration: none;color:black;padding-left:20px;margin:5px auto 8px auto">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/invoice" style="text-decoration: none;color:black;padding-left:20px;margin:5px auto 8px auto">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/saleorder" style="text-decoration: none;color:black;padding-left:20px;margin:5px auto 8px auto">Sale Order</a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="/purchaseorder" style="text-decoration: none;color:black;padding-left:20px;margin:5px auto 8px auto">Purchase Order</a>
                </li>

                <li class="nav-item">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Product
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="/product/create" style="text-decoration: none;">Create Product</a></div>
                            </div>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="/product" style="text-decoration: none;">View Product</a></div>
                            </div>
                        </div> <!-- accordion-item -->
                    </div><!-- accordion-flush -->
                </li>

                <li class="nav-item">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Category
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="/category/create" style="text-decoration: none;">Create Category</a></div>
                            </div>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="/category" style="text-decoration: none;">View Category</a></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Supplier
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="supplier/create" style="text-decoration: none;">Create Supplier</a></div>
                            </div>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="/supplier" style="text-decoration: none;">View Supplier</a></div>
                            </div>
                        </div> <!-- accordion-item -->
                    </div><!-- accordion-flush -->
                </li>
                @if (Auth::user()->user_roll == 1)
                <li class="nav-item">
                    <a class="nav-link" href="/user" style="text-decoration: none;color:black;padding-left:20px;margin:5px auto 8px auto">Users</a>
                </li>
                @endif
            </ul>
        </div>

        <div class="col-md-10">
            @yield('content')
        </div>
    </div><!-- row -->


</body>

</html>