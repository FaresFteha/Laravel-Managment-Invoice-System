<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      //ClientRepository
      'App\RepositoryInterface\ClientRepositoryInterface',
      'App\Repository\ClientRepository',
    );

    $this->app->bind(
      //CategoryRepository
      'App\RepositoryInterface\CategoryRepositoryInterface',
      'App\Repository\CategoryRepository',
    );

    $this->app->bind(
      //TaxRepository
      'App\RepositoryInterface\TaxRepositoryInterface',
      'App\Repository\TaxRepository',
    );

    $this->app->bind(
      //ProductRepository
      'App\RepositoryInterface\ProductRepositoryInterface',
      'App\Repository\ProductRepository',
    );

    $this->app->bind(
      //InvoiceRepository
      'App\RepositoryInterface\InvoiceRepositoryInterface',
      'App\Repository\InvoiceRepository',
    );

    $this->app->bind(
      //Invoice Attachments Repository
      'App\RepositoryInterface\InvoiceAttachmentsRepositoryInterface',
      'App\Repository\InvoiceAttachmentsRepository',
    );

    $this->app->bind(
      //InvoiceStatusRepository
      'App\RepositoryInterface\InvoiceStatusRepositoryInterface',
      'App\Repository\InvoiceStatusRepository',
    );

    $this->app->bind(
      //InvoiceArchiveRepository
      'App\RepositoryInterface\InvoiceArchiveRepositoryInterface',
      'App\Repository\InvoiceArchiveRepository',
    );

    $this->app->bind(
      //PaymentRepository
      'App\RepositoryInterface\PaymentRepositoryInterface',
      'App\Repository\PaymentRepository',
    );
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
