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

  describe '#by_auth' do
    let!(:kate) { create(:user, provider: 'google', uid: 'google-id') }
    let!(:fred) { create(:user, provider: 'facebook', uid: 'facebook-id') }
    let(:auth)  { double('auth', provider: 'facebook', uid: 'facebook-id') }

    it 'should be possible to find people by auth' do
      user = User.by_auth(auth)
      expect(user).to eq(fred)
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
  describe '#find_for_facebook' do
    context 'with valid auth' do
      before do
        @auth  = double('auth', provider: 'facebook', uid: 'uid', extra: { 'raw_info' => { 'name' => 'John Watson' } }, info: { 'email' => 'john.watson@example.com' })
        @user  = User.find_for_facebook(@auth)
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
        @auth  = double('auth', provider: 'facebook', uid: 'uid', extra: { 'raw_info' => { 'name' => '' } }, info: { 'email' => '' })
        @user  = User.find_for_facebook(@auth)
      end

      it 'should not create a new user' do
        expect(User.count).to eq(0)
      end
    end
  end

  describe '#find_for_google' do
    context 'with valid auth' do
      before do
        @auth = double('auth', provider: 'google', uid: 'uid', info: { 'email' => 'john.watson@example.com', 'name' => 'John Watson' })
        @user = User.find_for_google(@auth)
      end

      it 'should create a new user by facebook auth' do
        expect(User.count).to     eq(1)
        expect(@user.name).to     eq("John Watson")
        expect(@user.provider).to eq("google")
        expect(@user.uid).to      eq("uid")
        expect(@user.email).to    eq("john.watson@example.com")
      end
    end

    context 'with invalid auth' do
      before do
        @auth = double('auth', provider: 'google', uid: 'uid', info: { 'email' => '', 'name' => 'John Watson' })
        @user = User.find_for_google(@auth)
      end

      it 'should not create a new user' do
        expect(User.count).to eq(0)
      end
    end
  end
end

