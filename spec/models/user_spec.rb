require 'spec_helper'

describe User do
  it { should validate_presence_of(:name) }
end

describe User do
  describe '#role?' do
    describe '#admin' do
      let(:admin) { create(:admin) }

      it 'should be admin' do
        expect(admin.role?(:admin)).to be_true
      end
    end

    context '#user' do
      let(:user) { create(:user) }

      it 'should be normal user' do
        expect(user.role?(:admin)).to be_false
      end
    end
  end
end

describe User do
  context '#admin' do
    let(:admin) { create(:admin) }

    subject { Ability.new(admin) }

    it { should be_able_to(:manage, :all) }
  end
end

describe User do
  describe '#find_for_facebook_oauth' do
    context 'with valid auth' do
      before do
        @extra = double('extra', raw_info: double(name: 'John Watson'))
        @info  = double('info', email: "john.watson@example.com")
        @auth  = double('auth', provider: 'facebook', uid: "uid", extra: @extra, info: @info)
        @user  = User.find_for_facebook_oauth(@auth)
      end

      it 'should create a new user by facebook auth' do
        expect(User.count).to     eq(1)
        expect(@user.name).to     eq("John Watson")
        expect(@user.provider).to eq("facebook")
        expect(@user.uid).to      eq("uid")
        expect(@user.email).to    eq("john.watson@example.com")
      end
    end

    context 'with invalid auth' do
      before do
        @extra = double('extra', raw_info: double(name: ''))
        @info  = double('info', email: '')
        @auth  = double('auth', provider: 'facebook', uid: 'uid', extra: @extra, info: @info)
        @user  = User.find_for_facebook_oauth(@auth)
      end

      it 'should not create a new user' do
        expect(User.count).to eq(0)
      end
    end
  end
end

