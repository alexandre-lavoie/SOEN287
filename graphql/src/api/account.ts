import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, createUnionType } from 'type-graphql';
import Cart, { CartResolver, CartUpdate } from './cart';
import Order, { OrderResolver } from './order';
import { GET, Endpoint, DELETE, PUT, POST } from './rest';

@ObjectType()
export default class Account {
    @Field(type => ID)
    public id: string;

    @Field()
    public name: string;

    @Field({ nullable: true })
    public password?: string;

    @Field()
    public email: string;

    @Field()
    public address: string;

    @Field(type => Cart)
    public cart: Cart;

    @Field(type => [Order])
    public orders: Order[]
}

@InputType()
export class AccountCreate {
    @Field()
    public name: string;

    @Field()
    public password: string;

    @Field()
    public email: string;

    @Field()
    public address: string;
}

@InputType()
export class AccountUpdate {
    @Field(type => ID)
    public id: string;

    @Field({ nullable: true })
    public name?: string;

    @Field({ nullable: true })
    public password?: string;

    @Field({ nullable: true })
    public email?: string;

    @Field({ nullable: true })
    public address?: string;

    @Field(type => CartUpdate, { nullable: true })
    public cart?: CartUpdate;
}

@Resolver(of => Account)
export class AccountResolver {
    @FieldResolver()
    async cart(@Root() account: Account): Promise<Cart> {
        return new CartResolver().cart(account.cart.id);
    }

    @FieldResolver()
    async orders(@Root() account: Account): Promise<Order[]> {
        const orders = await new OrderResolver().orders();

        return orders.filter(order => order.account.id == account.id);
    }

    @Query(returns => Account)
    async account(@Arg("id") id: string): Promise<Account> {
        const json = await GET(Endpoint.accounts, { id });
        const account = json.accounts[id] as any;

        return { ...account, cart: { id: account.cart } };
    }

    @Query(returns => [Account])
    async accounts(): Promise<Account[]> {
        const json = await GET(Endpoint.accounts);
        
        return Object.values(json.accounts).map((account: any) => ({ ...account, cart: { id: account.cart }}));
    }

        /**
     * TODO: Implement.
     */
    @Mutation(returns => Order)
    async createAccount(@Arg("input") input: AccountCreate) {
        return await POST(Endpoint.accounts, input);
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Account)
    async updateAccount(@Arg("input") input: AccountUpdate) {
        return await PUT(Endpoint.accounts, input);
    }

    @Mutation(returns => Account)
    async deleteAccount(@Arg("id") id: string) {
        const account = await this.account(id);

        if (account == undefined) return undefined;

        await DELETE(Endpoint.accounts, account.id);

        return account;
    }
}