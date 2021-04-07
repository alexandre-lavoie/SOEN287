import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, createUnionType } from 'type-graphql';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';

export interface RESTSplash {
    id: string
    name: string
    description: string
    image: string
}

@ObjectType()
export default class Splash {
    @Field(type => ID)
    public id: string;

    @Field()
    public title: string;

    @Field()
    public description: string;

    @Field()
    public image: string;
}

@InputType()
export class SplashCreate {
    @Field()
    public title: string;

    @Field()
    public description: string;

    @Field()
    public image: string;
}

@InputType()
export class SplashUpdate {
    @Field(type => ID)
    public id: string;

    @Field({ nullable: true })
    public title?: string;

    @Field({ nullable: true })
    public description?: string;

    @Field({ nullable: true })
    public image?: string;
}

@Resolver(of => Splash)
export class SplashResolver {
    public restToQL(data: RESTSplash): Splash {
        return {
            ...data,
            title: data.name
        }
    }

    public qlToREST(splash: Splash): RESTSplash {
        return {
            ...splash,
            name: splash.title
        }
    }

    @Query(returns => Splash)
    async splash(@Arg("id") id: string): Promise<Splash> {
        const json = await GET(Endpoint.splashs, { id });

        return this.restToQL(json.splashs[id] as any);
    }

    @Query(returns => [Splash])
    async splashs(): Promise<Splash[]> {
        const json = await GET(Endpoint.splashs);

        return Object.values(json.splashs).map((splash: any) => this.restToQL(splash));
    }

    @Mutation(returns => Splash)
    async createSplash(@Arg("input") input: SplashCreate): Promise<Splash> {
        return this.restToQL(await POST(Endpoint.splashs, this.qlToREST(input as any)));
    }

    @Mutation(returns => Splash)
    async updateSplash(@Arg("input") input?: SplashUpdate): Promise<Splash> {
        if (input == null) return null;

        return this.restToQL(await PUT(Endpoint.splashs, this.qlToREST(input as any)));
    }

    @Mutation(returns => Splash)
    async deleteSplash(@Arg("id") id: string): Promise<Splash> {
        return this.restToQL(await DELETE(Endpoint.splashs, id));
    }
}