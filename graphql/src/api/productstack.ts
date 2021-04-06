import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface } from 'type-graphql';
import Product, { ProductResolver, ProductUpdate } from './product';

@ObjectType()
export default class ProductStack {
    @Field(type => ID)
    public id: string;

    @Field(type => Product)
    public product: Product;

    @Field()
    public quantity: string;
}

@InputType()
export class ProductStackCreate {
    @Field(type => ID)
    public product: string;

    @Field()
    public quantity: string;
}

@InputType()
export class ProductStackUpdate {
    @Field(type => ID)
    public id: string;

    @Field(type => ProductUpdate, { nullable: true })
    public product?: ProductUpdate;

    @Field({ nullable: true })
    public quantity?: string;
}

@Resolver(of => ProductStack)
export class ProductStackResolver implements ResolverInterface<ProductStack> {
    @FieldResolver()
    async product(@Root() productstack: ProductStack): Promise<Product> {
        return new ProductResolver().product(productstack.product.id);
    }
}