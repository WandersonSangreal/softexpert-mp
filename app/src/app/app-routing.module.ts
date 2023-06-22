import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {ProductsComponent} from "./products/products.component";
import {TypesComponent} from "./types/types.component";
import {TaxesComponent} from "./taxes/taxes.component";
import {CartComponent} from "./cart/cart.component";

const routes: Routes = [
	{
		path: 'products',
		component: ProductsComponent
	},
	{
		path: 'types',
		component: TypesComponent
	},
	{
		path: 'taxes',
		component: TaxesComponent
	},
	{
		path: 'cart',
		component: CartComponent
	}
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule {
}
