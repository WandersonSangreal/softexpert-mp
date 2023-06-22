import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import { HeaderComponent } from './header/header.component';
import { ProductsComponent } from './products/products.component';
import { TypesComponent } from './types/types.component';
import { TaxesComponent } from './taxes/taxes.component';
import { CartComponent } from './cart/cart.component';

@NgModule({
	declarations: [
		AppComponent,
  HeaderComponent,
  ProductsComponent,
  TypesComponent,
  TaxesComponent,
  CartComponent
	],
	imports: [
		BrowserModule,
		AppRoutingModule
	],
	providers: [],
	bootstrap: [AppComponent]
})
export class AppModule {
}
