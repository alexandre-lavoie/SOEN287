import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface, createUnionType } from 'type-graphql';
import ProductStack, { ProductStackCreate, ProductStackUpdate } from './productstack';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';

@ObjectType()
export default class Cart {
    @Field(type => ID)
    public id: string;

    @Field(type => [ProductStack])
    public productstacks: ProductStack[];
}

@InputType()
export class CartCreate {
    @Field(type => [ProductStackCreate])
    public productstacks: ProductStackCreate[];
}

@InputType()
export class CartUpdate {
    @Field(type => ID)
    public id: string;

    @Field(type => [ProductStackUpdate], { nullable: true })
    public productstacks?: ProductStackUpdate[];
}

@Resolver(of => Cart)
export class CartResolver {
    @Query(returns => Cart)
    async cart(@Arg("id") id: string): Promise<Cart> {
        const json = await GET(Endpoint.carts, { id });
        const cart = json.carts[id] as any;

        cart.productstacks = Object.values(cart.itemstacks).map((itemstack: any) => ({ 
            ...itemstack, 
            product: { 
                id: itemstack.item 
            }
        }));

        return cart;
    }

    @Query(returns => [Cart])
    async carts(): Promise<Cart[]> {
        const json = await GET(Endpoint.carts);

        return Object.values(json.carts).map((cart: any) => ({
            ...cart,
            productstacks: Object.values(cart.itemstacks).map((itemstack: any) => ({ 
                ...itemstack, 
                product: { 
                    id: itemstack.item 
                }
            }))
        }));
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Cart)
    async createCart(@Arg("input") input: CartCreate) {
        return await POST(Endpoint.carts, input);
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Cart)
    async updateCart(@Arg("input") input: CartUpdate) {
        return await PUT(Endpoint.carts, input);
    }

    @Mutation(returns => Cart)
    async deleteCart(@Arg("id") id: string) {
        const cart = await this.cart(id);

        if (cart == undefined) return undefined;

        await DELETE(Endpoint.carts, cart.id);

        return cart;
    }
}