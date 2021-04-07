import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface } from 'type-graphql';
import Product, { ProductResolver, ProductUpdate } from './product';
import { IREST } from './rest';

export interface RESTProductStack extends IREST {
    id: string
    item: string
    quantity: string
}

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
    public restToQL(data: RESTProductStack): ProductStack {
        return {
            ...data,
            product: {
                id: data.item
            }
        } as any;
    }

    public qlToREST(productstack: ProductStack): RESTProductStack {
        return {
            ...productstack,
            item: productstack.product.id
        };
    }

    async createProductStack(id: string, input: ProductStackCreate): Promise<ProductStack> {
        return { ...input, id, product: { id: input.product } } as any;
    }

    async updateProductStack(input: ProductStackUpdate): Promise<ProductStack> {
        await new ProductResolver().updateProduct(input.product);

        return { ...input } as any;
    }

    @FieldResolver()
    async product(@Root() productstack: ProductStack): Promise<Product> {
        return new ProductResolver().product(productstack.product.id);
    }
}